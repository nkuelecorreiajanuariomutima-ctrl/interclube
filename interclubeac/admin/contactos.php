<?php
require_once '../includes/config.php';
requireAdmin();
$db = getDB();
$contactos = $db->query("SELECT * FROM contactos ORDER BY data_envio DESC")->fetchAll();
if(isset($_GET['marcar'])){
  $db->prepare("UPDATE contactos SET lido=1 WHERE id=?")->execute([$_GET['marcar']]);
  header('Location: contactos.php'); exit;
}
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mensagens — Admin Inter Clube</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php include '_sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="topbar-title">Mensagens <small><?= count($contactos) ?> total</small></div>
  </div>
  <div class="content">
    <div class="card">
      <div style="overflow-x:auto">
        <table class="table-dark-custom" style="width:100%">
          <thead><tr><th></th><th>Nome</th><th>Email</th><th>Assunto</th><th>Data</th><th>Acções</th></tr></thead>
          <tbody>
          <?php foreach($contactos as $c): ?>
          <tr style="<?= !$c['lido']?'background:rgba(13,110,253,.04)':'' ?>" id="ct-<?= $c['id'] ?>">
            <td style="width:8px;padding:0">
              <?php if(!$c['lido']): ?>
              <div style="width:4px;height:100%;background:var(--blue);position:absolute;left:0;top:0"></div>
              <?php endif; ?>
            </td>
            <td style="font-weight:<?= !$c['lido']?'700':'400' ?>">
              <?php if(!$c['lido']): ?><span style="color:var(--blue);font-size:.65rem;vertical-align:middle;margin-right:.35rem">●</span><?php endif; ?>
              <?= htmlspecialchars($c['nome']) ?>
            </td>
            <td style="color:var(--muted);font-size:.82rem"><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['assunto']?:'—') ?></td>
            <td style="color:var(--muted);font-size:.82rem"><?= date('d/m/Y H:i',strtotime($c['data_envio'])) ?></td>
            <td>
              <div style="display:flex;gap:.35rem">
                <button class="btn-act view" onclick="verMsg(<?= htmlspecialchars(json_encode($c)) ?>)"><i class="fa fa-eye"></i> Ver</button>
                <?php if(!$c['lido']): ?>
                <a href="?marcar=<?= $c['id'] ?>" class="btn-act approve"><i class="fa fa-check"></i> Lido</a>
                <?php endif; ?>
                <a href="mailto:<?= htmlspecialchars($c['email']) ?>" class="btn-act edit"><i class="fa fa-reply"></i></a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($contactos)): ?>
          <tr><td colspan="6" style="text-align:center;padding:3rem;color:var(--muted)"><i class="fa fa-inbox fa-2x" style="display:block;margin-bottom:.75rem;opacity:.3"></i>Sem mensagens</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-dark" id="mMsg" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title"><i class="fa fa-envelope me-2" style="color:var(--blue)"></i>MENSAGEM</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body" id="mMsgBody"></div>
    <div class="modal-footer">
      <button class="btn-topbar ghost" data-bs-dismiss="modal">Fechar</button>
      <a id="mMsgReply" href="#" class="btn-topbar primary"><i class="fa fa-reply me-1"></i>Responder</a>
    </div>
  </div></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function verMsg(c){
  document.getElementById('mMsgBody').innerHTML=
    '<div style="display:grid;gap:.6rem;font-size:.875rem">'+
    '<div><span style="color:var(--muted)">De:</span> <strong>'+c.nome+'</strong> &lt;'+c.email+'&gt;</div>'+
    '<div><span style="color:var(--muted)">Tel:</span> '+(c.telefone||'—')+'</div>'+
    '<div><span style="color:var(--muted)">Assunto:</span> '+(c.assunto||'—')+'</div>'+
    '<hr style="border-color:var(--border)">'+
    '<div style="background:var(--bg3);border-radius:8px;padding:1rem;line-height:1.6">'+c.mensagem+'</div>'+
    '</div>';
  document.getElementById('mMsgReply').href='mailto:'+c.email+'?subject=Re: '+(c.assunto||'');
  new bootstrap.Modal(document.getElementById('mMsg')).show();
}
</script>
</body></html>
