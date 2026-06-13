<?php
require_once '../includes/config.php';
requireAdmin();
$db = getDB();
$id   = intval($_GET['id'] ?? 0);
$stmt = $db->prepare("SELECT * FROM candidaturas WHERE id=?");
$stmt->execute([$id]);
$c = $stmt->fetch();
if (!$c) { header('Location: candidaturas.php'); exit; }
$idade = date_diff(date_create($c['data_nascimento']), date_create('today'))->y;
$sLabel=['pendente'=>'Pendente','pagamento_pendente'=>'Pag. Pendente','em_analise'=>'Em Análise','aprovado'=>'Aprovado','rejeitado'=>'Rejeitado'];
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Candidatura <?= htmlspecialchars($c['rup']) ?> — Admin</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php include '_sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="topbar-title">
      <?= htmlspecialchars($c['nome_completo']) ?>
      <small><?= htmlspecialchars($c['rup']) ?></small>
    </div>
    <span class="badge-status bs-<?= $c['status'] ?>"><?= $sLabel[$c['status']]??$c['status'] ?></span>
    <a href="candidaturas.php" class="btn-topbar ghost"><i class="fa fa-arrow-left me-1"></i>Voltar</a>
  </div>

  <div class="content">
  <div id="alerta" style="display:none;margin-bottom:1rem"></div>
  <div class="row g-4">

    <!-- Coluna principal -->
    <div class="col-lg-8">

      <!-- Dados pessoais -->
      <div class="card mb-4">
        <div class="card-header-bar"><h6><i class="fa fa-user me-2" style="color:var(--blue)"></i>DADOS PESSOAIS</h6></div>
        <div class="card-body">
          <div class="row g-3">
            <?php
            $campos=[
              ['RUP',           $c['rup']??'—',                                                          true],
              ['Nome Completo', $c['nome_completo']??'—',                                                false],
              ['Data Nascimento',date('d/m/Y',strtotime($c['data_nascimento']))." ($idade anos)",        false],
              ['Categoria',     $c['categoria']??'—',                                                    false],
              ['BI',            $c['bi']??'—',                                                           false],
              ['Género',        ($c['genero']??'')==='M'?'Masculino':(($c['genero']??'')==='F'?'Feminino':'—'), false],
              ['Província',     $c['provincia']??'—',                                                    false],
              ['Município',     $c['municipio']??'—',                                                    false],
              ['Bairro',        $c['bairro']??'—',                                                       false],
              ['Nome do Pai',   $c['nome_pai']??'—',                                                     false],
              ['Nome da Mãe',   $c['nome_mae']??'—',                                                     false],
            ];
            foreach($campos as $f): ?>
            <div class="col-md-6">
              <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;margin-bottom:.2rem"><?= $f[0] ?></div>
              <div style="font-weight:600;color:<?= $f[2]?'var(--blue)':'var(--text)' ?>;font-family:<?= $f[2]?'var(--font-d)':'inherit' ?>;letter-spacing:<?= $f[2]?'2px':'0' ?>">
                <?= htmlspecialchars($f[1]) ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Contactos -->
      <div class="card mb-4">
        <div class="card-header-bar"><h6><i class="fa fa-phone me-2" style="color:var(--blue)"></i>CONTACTOS</h6></div>
        <div class="card-body">
          <div class="row g-3">
            <?php foreach([['Email',$c['email']??'—'],['Telefone',$c['telefone']??'—'],['Emergência',$c['contacto_emergencia']??'—']] as $f): ?>
            <div class="col-md-4">
              <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;margin-bottom:.2rem"><?= $f[0] ?></div>
              <div style="font-weight:600;color:var(--text)"><?= htmlspecialchars($f[1]?:'—') ?></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Dados desportivos -->
      <div class="card">
        <div class="card-header-bar"><h6><i class="fa fa-futbol me-2" style="color:var(--blue)"></i>DADOS DESPORTIVOS</h6></div>
        <div class="card-body">
          <div class="row g-3">
            <?php foreach([['Posição',$c['posicao_preferida']??'—'],['Clube Anterior',$c['clube_anterior']??'—'],['Valor Inscrição',number_format(floatval($c['valor_inscricao']??0),0,',','.').' AOA']] as $f): ?>
            <div class="col-md-4">
              <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;margin-bottom:.2rem"><?= $f[0] ?></div>
              <div style="font-weight:600;color:var(--text)"><?= htmlspecialchars($f[1]) ?></div>
            </div>
            <?php endforeach; ?>
            <?php if($c['observacoes']): ?>
            <div class="col-12">
              <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem">Observações</div>
              <div style="background:var(--bg3);border-radius:8px;padding:.875rem;color:var(--text);font-size:.875rem;line-height:1.6"><?= nl2br(htmlspecialchars($c['observacoes'])) ?></div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>

    <!-- Coluna lateral -->
    <div class="col-lg-4">

      <!-- Foto -->
      <?php if($c['foto_atleta']): ?>
      <div class="card mb-4">
        <div class="card-header-bar"><h6><i class="fa fa-camera me-2" style="color:var(--blue)"></i>FOTO</h6></div>
        <div class="card-body" style="text-align:center">
          <img src="../uploads/<?= htmlspecialchars($c['foto_atleta']) ?>" style="max-height:200px;border-radius:8px;object-fit:cover;width:100%">
        </div>
      </div>
      <?php endif; ?>

      <!-- Comprovativo -->
      <div class="card mb-4">
        <div class="card-header-bar"><h6><i class="fa fa-file-invoice me-2" style="color:var(--blue)"></i>COMPROVATIVO</h6></div>
        <div class="card-body">
          <?php if($c['comprovativo_pagamento']): ?>
            <?php $ext=strtolower(pathinfo($c['comprovativo_pagamento'],PATHINFO_EXTENSION)); ?>
            <?php if(in_array($ext,['jpg','jpeg','png'])): ?>
            <a href="../uploads/<?= htmlspecialchars($c['comprovativo_pagamento']) ?>" target="_blank">
              <img src="../uploads/<?= htmlspecialchars($c['comprovativo_pagamento']) ?>" style="max-height:150px;border-radius:8px;width:100%;object-fit:cover">
            </a>
            <?php else: ?>
            <a href="../uploads/<?= htmlspecialchars($c['comprovativo_pagamento']) ?>" target="_blank" class="btn-topbar ghost" style="display:flex;justify-content:center">
              <i class="fa fa-file-pdf me-2"></i>Ver PDF
            </a>
            <?php endif; ?>
          <?php else: ?>
          <div style="text-align:center;padding:1.5rem;color:var(--muted)">
            <i class="fa fa-file-upload fa-2x" style="display:block;margin-bottom:.5rem;opacity:.3"></i>
            Sem comprovativo submetido
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Acções -->
      <div class="card mb-4">
        <div class="card-header-bar"><h6><i class="fa fa-bolt me-2" style="color:var(--warning)"></i>ACÇÕES</h6></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:.6rem">
          <?php if($c['status']!=='aprovado'): ?>
          <button class="btn-topbar primary" style="justify-content:center" onclick="mudar(<?=$id?>,'aprovado')">
            <i class="fa fa-check me-2"></i>APROVAR
          </button>
          <?php endif; ?>
          <?php if($c['status']!=='rejeitado'): ?>
          <button class="btn-topbar primary" style="background:var(--danger);justify-content:center" onclick="abrirRejeitar(<?=$id?>)">
            <i class="fa fa-times me-2"></i>REJEITAR
          </button>
          <?php endif; ?>
          <?php if($c['status']==='pendente'||$c['status']==='pagamento_pendente'): ?>
          <button class="btn-topbar ghost" style="justify-content:center" onclick="mudar(<?=$id?>,'em_analise')">
            <i class="fa fa-search me-2"></i>Marcar Em Análise
          </button>
          <?php endif; ?>
        </div>
      </div>

      <!-- Notas internas -->
      <div class="card">
        <div class="card-header-bar"><h6><i class="fa fa-sticky-note me-2" style="color:var(--warning)"></i>NOTAS INTERNAS</h6></div>
        <div class="card-body">
          <textarea class="ic-input-dark" id="notas" rows="4" placeholder="Notas para uso interno..."><?= htmlspecialchars($c['notas_admin']??'') ?></textarea>
          <button class="btn-topbar ghost" style="width:100%;justify-content:center;margin-top:.75rem" onclick="guardarNotas(<?=$id?>)">
            <i class="fa fa-save me-1"></i>Guardar Notas
          </button>
        </div>
      </div>

    </div>
  </div>
  </div>
</div>

<!-- Modal rejeitar -->
<div class="modal fade modal-dark" id="mRejeitar" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title"><i class="fa fa-times-circle me-2" style="color:var(--danger)"></i>REJEITAR CANDIDATURA</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="rjId">
      <label class="ic-label">Motivo *</label>
      <textarea class="ic-input-dark" id="rjMotivo" rows="4" placeholder="Descreva o motivo da rejeição..."></textarea>
    </div>
    <div class="modal-footer">
      <button class="btn-topbar ghost" data-bs-dismiss="modal">Cancelar</button>
      <button class="btn-topbar primary" style="background:var(--danger)" onclick="executarRejeicao()">Confirmar</button>
    </div>
  </div></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function alerta(msg,ok){
  var box=document.getElementById('alerta');
  box.style.display='block';
  box.innerHTML='<div style="background:'+(ok?'rgba(16,185,129,.12)':'rgba(239,68,68,.12)')+';border:1px solid '+(ok?'rgba(16,185,129,.3)':'rgba(239,68,68,.3)')+';border-radius:8px;padding:.75rem 1rem;color:'+(ok?'#10b981':'#ef4444')+';font-size:.875rem"><i class="fa fa-'+(ok?'check':'exclamation')+='-circle me-2"></i>'+msg+'</div>';
  setTimeout(function(){box.style.display='none';},3000);
}
async function mudar(id,status){
  if(!confirm('Confirma a alteração?')) return;
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'mudar_status',id,status})});
  const d=await r.json(); if(d.success) location.reload(); else alerta('Erro: '+d.message,false);
}
function abrirRejeitar(id){ document.getElementById('rjId').value=id; document.getElementById('rjMotivo').value=''; new bootstrap.Modal(document.getElementById('mRejeitar')).show(); }
async function executarRejeicao(){
  const id=document.getElementById('rjId').value;
  const motivo=document.getElementById('rjMotivo').value.trim();
  if(!motivo){alert('Insira o motivo.');return;}
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'rejeitar',id,motivo})});
  const d=await r.json(); if(d.success) location.reload(); else alerta('Erro: '+d.message,false);
}
async function guardarNotas(id){
  const notas=document.getElementById('notas').value;
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'notas',id,notas})});
  const d=await r.json(); alerta(d.success?'Notas guardadas!':'Erro ao guardar.',d.success);
}
</script>
</body></html>
