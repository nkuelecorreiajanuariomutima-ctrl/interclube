<?php
require_once '../includes/config.php';
requireAdmin();
$db = getDB();

$status = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';
$page   = max(1,intval($_GET['page']??1));
$per    = 20; $off = ($page-1)*$per;

$where = "WHERE 1=1"; $params = [];
if ($status){ $where.=" AND status=?"; $params[]=$status; }
if ($search){ $where.=" AND (nome_completo LIKE ? OR bi LIKE ? OR email LIKE ? OR rup LIKE ?)"; $params=array_merge($params,["%$search%","%$search%","%$search%","%$search%"]); }

$total = $db->prepare("SELECT COUNT(*) FROM candidaturas $where");
$total->execute($params); $totalRows=$total->fetchColumn();
$pages = ceil($totalRows/$per);

$stmt = $db->prepare("SELECT * FROM candidaturas $where ORDER BY data_candidatura DESC LIMIT $per OFFSET $off");
$stmt->execute($params); $candidaturas=$stmt->fetchAll();

$sOpts=[''=>'Todos','pendente'=>'Pendente','pagamento_pendente'=>'Pag. Pendente','em_analise'=>'Em Análise','aprovado'=>'Aprovado','rejeitado'=>'Rejeitado'];
$sLabel=['pendente'=>'Pendente','pagamento_pendente'=>'Pag. Pendente','em_analise'=>'Em Análise','aprovado'=>'Aprovado','rejeitado'=>'Rejeitado'];
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Candidaturas — Admin Inter Clube</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php include '_sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="topbar-title">Candidaturas <small>Total: <?= $totalRows ?> registos</small></div>
  </div>
  <div class="content">

    <!-- Filtros -->
    <div class="card mb-4">
      <div class="card-body" style="padding:1.25rem">
        <form method="GET" class="search-bar">
          <div style="flex:1;min-width:200px">
            <label class="ic-label">Pesquisar</label>
            <input type="text" name="search" class="ic-input-dark" placeholder="Nome, BI, Email, RUP..." value="<?= htmlspecialchars($search) ?>">
          </div>
          <div style="min-width:160px">
            <label class="ic-label">Estado</label>
            <select name="status" class="ic-input-dark">
              <?php foreach($sOpts as $v=>$l): ?>
              <option value="<?= $v ?>" <?= $status===$v?'selected':'' ?>><?= $l ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div style="display:flex;gap:.5rem;align-self:flex-end">
            <button type="submit" class="btn-topbar primary"><i class="fa fa-search me-1"></i>Filtrar</button>
            <a href="candidaturas.php" class="btn-topbar ghost">Limpar</a>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabela -->
    <div class="card">
      <div style="overflow-x:auto">
        <table class="table-dark-custom" style="width:100%">
          <thead><tr>
            <th>RUP</th><th>Nome</th><th>BI</th><th>Categoria</th><th>Estado</th><th>Data</th><th>Acções</th>
          </tr></thead>
          <tbody>
          <?php foreach($candidaturas as $c): ?>
          <tr>
            <td><span class="rup-cell"><?= htmlspecialchars($c['rup']) ?></span></td>
            <td style="font-weight:600"><?= htmlspecialchars($c['nome_completo']) ?></td>
            <td style="color:var(--muted);font-size:.82rem"><?= htmlspecialchars($c['bi']) ?></td>
            <td style="color:var(--muted)"><?= htmlspecialchars($c['categoria']) ?></td>
            <td><span class="badge-status bs-<?= $c['status'] ?>"><?= $sLabel[$c['status']]??$c['status'] ?></span></td>
            <td style="color:var(--muted);font-size:.82rem"><?= date('d/m/Y',strtotime($c['data_candidatura'])) ?></td>
            <td>
              <div style="display:flex;gap:.35rem;flex-wrap:wrap">
                <a href="candidatura_detalhe.php?id=<?= $c['id'] ?>" class="btn-act view"><i class="fa fa-eye"></i> Ver</a>
                <?php if(!in_array($c['status'],['aprovado','rejeitado'])): ?>
                <button class="btn-act approve" onclick="aprovar(<?= $c['id'] ?>)"><i class="fa fa-check"></i> Aprovar</button>
                <button class="btn-act reject"  onclick="rejeitar(<?= $c['id'] ?>)"><i class="fa fa-times"></i> Rejeitar</button>
                <?php endif; ?>
                <button class="btn-act del" onclick="eliminar(<?= $c['id'] ?>)"><i class="fa fa-trash"></i></button>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($candidaturas)): ?>
          <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--muted)"><i class="fa fa-inbox fa-2x" style="display:block;margin-bottom:.75rem;opacity:.3"></i>Nenhuma candidatura encontrada</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Paginação -->
    <?php if($pages>1): ?>
    <div style="display:flex;justify-content:center;gap:.5rem;margin-top:1.5rem">
      <?php for($i=1;$i<=$pages;$i++): ?>
      <a href="?page=<?=$i?>&status=<?=urlencode($status)?>&search=<?=urlencode($search)?>"
         style="padding:.4rem .85rem;border-radius:6px;font-size:.82rem;text-decoration:none;<?= $i==$page?'background:var(--blue);color:#fff':'background:var(--bg3);color:var(--muted);border:1px solid var(--border)' ?>">
        <?= $i ?>
      </a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>
  </div>
</div>

<!-- Modal rejeitar -->
<div class="modal fade modal-dark" id="mRejeitar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-times-circle me-2" style="color:var(--danger)"></i>REJEITAR CANDIDATURA</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="rjId">
        <label class="ic-label">Motivo da Rejeição *</label>
        <textarea class="ic-input-dark" id="rjMotivo" rows="4" placeholder="Descreva o motivo..."></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn-topbar ghost" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn-topbar primary" onclick="confirmarRejeicao()" style="background:var(--danger)">Confirmar Rejeição</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
async function aprovar(id){
  if(!confirm('Confirma a aprovação?')) return;
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'aprovar',id})});
  const d=await r.json(); if(d.success) location.reload(); else alert(d.message);
}
function rejeitar(id){ document.getElementById('rjId').value=id; document.getElementById('rjMotivo').value=''; new bootstrap.Modal(document.getElementById('mRejeitar')).show(); }
async function confirmarRejeicao(){
  const id=document.getElementById('rjId').value;
  const motivo=document.getElementById('rjMotivo').value.trim();
  if(!motivo){alert('Insira o motivo.');return;}
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'rejeitar',id,motivo})});
  const d=await r.json(); if(d.success) location.reload(); else alert(d.message);
}
async function eliminar(id){
  if(!confirm('Eliminar esta candidatura? Esta acção é irreversível.')) return;
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'eliminar_candidatura',id})});
  const d=await r.json(); if(d.success) location.reload(); else alert(d.message);
}
</script>
</body></html>
