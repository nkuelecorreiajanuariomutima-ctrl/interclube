<?php
require_once '../includes/config.php';
requireAdmin();
$db = getDB();
$eventos = $db->query("SELECT * FROM eventos ORDER BY data_evento DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eventos — Admin Inter Clube</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php include '_sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="topbar-title">Eventos <small><?= count($eventos) ?> eventos</small></div>
    <button class="btn-topbar primary" onclick="abrirModal()"><i class="fa fa-plus me-1"></i>Novo Evento</button>
  </div>
  <div class="content">
    <div class="card">
      <div style="overflow-x:auto">
        <table class="table-dark-custom" style="width:100%">
          <thead><tr><th>Título</th><th>Data</th><th>Local</th><th>Publicado</th><th>Destaque</th><th>Acções</th></tr></thead>
          <tbody>
          <?php foreach($eventos as $ev): ?>
          <tr id="ev-<?= $ev['id'] ?>">
            <td style="font-weight:600"><?= htmlspecialchars($ev['titulo']) ?></td>
            <td style="color:var(--muted)"><?= date('d/m/Y',strtotime($ev['data_evento'])) ?></td>
            <td style="color:var(--muted);font-size:.82rem"><?= htmlspecialchars($ev['local_evento']?:'—') ?></td>
            <td>
              <div class="form-check form-switch mb-0">
                <input class="form-check-input" type="checkbox" <?= $ev['publicado']?'checked':'' ?> onchange="togglePublicar(<?= $ev['id'] ?>,this.checked)">
              </div>
            </td>
            <td>
              <?php if($ev['destaque']): ?>
              <span class="badge-status" style="background:rgba(245,158,11,.15);color:#f59e0b;border:1px solid rgba(245,158,11,.25)"><i class="fa fa-star me-1"></i>Destaque</span>
              <?php else: ?><span style="color:var(--muted)">—</span><?php endif; ?>
            </td>
            <td>
              <div style="display:flex;gap:.35rem">
                <button class="btn-act edit" onclick='editarEvento(<?= json_encode($ev) ?>)'><i class="fa fa-edit"></i> Editar</button>
                <button class="btn-act del"  onclick="deletarEvento(<?= $ev['id'] ?>)"><i class="fa fa-trash"></i></button>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($eventos)): ?>
          <tr><td colspan="6" style="text-align:center;padding:3rem;color:var(--muted)"><i class="fa fa-calendar fa-2x" style="display:block;margin-bottom:.75rem;opacity:.3"></i>Sem eventos criados</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade modal-dark" id="mEvento" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mTitulo"><i class="fa fa-calendar-alt me-2" style="color:var(--blue)"></i>NOVO EVENTO</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="evId">
        <div class="row g-3">
          <div class="col-12"><label class="ic-label">Título *</label><input type="text" class="ic-input-dark" id="evTitulo" placeholder="Título do evento"></div>
          <div class="col-12"><label class="ic-label">Descrição</label><textarea class="ic-input-dark" id="evDescricao" rows="3" placeholder="Descrição..."></textarea></div>
          <div class="col-md-4"><label class="ic-label">Data *</label><input type="date" class="ic-input-dark" id="evData"></div>
          <div class="col-md-4"><label class="ic-label">Hora</label><input type="time" class="ic-input-dark" id="evHora"></div>
          <div class="col-md-4"><label class="ic-label">Local</label><input type="text" class="ic-input-dark" id="evLocal" placeholder="Local do evento"></div>
          <div class="col-6">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="evPublicado">
              <label class="form-check-label" style="color:var(--muted);font-size:.85rem">Publicar no site</label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="evDestaque">
              <label class="form-check-label" style="color:var(--muted);font-size:.85rem">Marcar como Destaque</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn-topbar ghost" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn-topbar primary" onclick="salvarEvento()"><i class="fa fa-save me-1"></i>Guardar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
var mEvento;
document.addEventListener('DOMContentLoaded',function(){ mEvento=new bootstrap.Modal(document.getElementById('mEvento')); });
function abrirModal(){
  document.getElementById('evId').value=''; document.getElementById('evTitulo').value='';
  document.getElementById('evDescricao').value=''; document.getElementById('evData').value='';
  document.getElementById('evHora').value=''; document.getElementById('evLocal').value='';
  document.getElementById('evPublicado').checked=false; document.getElementById('evDestaque').checked=false;
  document.getElementById('mTitulo').innerHTML='<i class="fa fa-calendar-alt me-2" style="color:var(--blue)"></i>NOVO EVENTO';
  mEvento.show();
}
function editarEvento(ev){
  document.getElementById('evId').value=ev.id; document.getElementById('evTitulo').value=ev.titulo;
  document.getElementById('evDescricao').value=ev.descricao||''; document.getElementById('evData').value=ev.data_evento;
  document.getElementById('evHora').value=ev.hora_evento||''; document.getElementById('evLocal').value=ev.local_evento||'';
  document.getElementById('evPublicado').checked=ev.publicado==1; document.getElementById('evDestaque').checked=ev.destaque==1;
  document.getElementById('mTitulo').innerHTML='<i class="fa fa-edit me-2" style="color:var(--warning)"></i>EDITAR EVENTO';
  mEvento.show();
}
async function salvarEvento(){
  const titulo=document.getElementById('evTitulo').value.trim();
  const data=document.getElementById('evData').value;
  if(!titulo||!data){alert('Preencha título e data.');return;}
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({
    acao:'salvar_evento',id:parseInt(document.getElementById('evId').value||0),titulo,
    descricao:document.getElementById('evDescricao').value,data_evento:data,
    hora_evento:document.getElementById('evHora').value,local_evento:document.getElementById('evLocal').value,
    publicado:document.getElementById('evPublicado').checked?1:0,destaque:document.getElementById('evDestaque').checked?1:0
  })});
  const d=await r.json(); if(d.success){mEvento.hide();location.reload();}else alert('Erro ao guardar.');
}
async function togglePublicar(id,pub){
  await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'publicar_evento',id,publicado:pub?1:0})});
}
async function deletarEvento(id){
  if(!confirm('Eliminar este evento?')) return;
  const r=await fetch('api_admin.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({acao:'deletar_evento',id})});
  const d=await r.json(); if(d.success) document.getElementById('ev-'+id)?.remove();
}
</script>
</body></html>
