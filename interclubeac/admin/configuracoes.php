<?php
require_once '../includes/config.php';
requireAdmin();
$db  = getDB();
$tab = $_GET['tab'] ?? 'perfil';
$msg = ''; $msgTipo = '';

// Perfil
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['acao'])) {
  $acao = $_POST['acao'];
  if ($acao==='perfil') {
    $nome = sanitize($_POST['nome']??'');
    $email= sanitize($_POST['email']??'');
    if ($nome && $email) {
      $db->prepare("UPDATE admins SET nome=?,email=? WHERE id=?")->execute([$nome,$email,$_SESSION['admin_id']]);
      $_SESSION['admin_nome']=$nome;
      $msg='Perfil actualizado!'; $msgTipo='ok'; $tab='perfil';
    }
  }
  if ($acao==='senha') {
    $atual  = $_POST['atual']??'';
    $nova   = $_POST['nova']??'';
    $confirm= $_POST['confirmar']??'';
    $adm    = $db->prepare("SELECT password FROM admins WHERE id=?"); $adm->execute([$_SESSION['admin_id']]); $adm=$adm->fetch();
    if (!password_verify($atual,$adm['password'])) { $msg='Palavra-passe actual incorrecta.'; $msgTipo='err'; }
    elseif (strlen($nova)<8) { $msg='A nova palavra-passe deve ter mínimo 8 caracteres.'; $msgTipo='err'; }
    elseif ($nova!==$confirm) { $msg='As palavras-passe não coincidem.'; $msgTipo='err'; }
    else { $db->prepare("UPDATE admins SET password=? WHERE id=?")->execute([password_hash($nova,PASSWORD_DEFAULT),$_SESSION['admin_id']]); $msg='Senha alterada!'; $msgTipo='ok'; }
    $tab='senha';
  }
  if ($acao==='cat' && $_SESSION['admin_nivel']==='super_admin') {
    foreach ($_POST['valor'] as $cid=>$val) {
      $ativo = isset($_POST['ativo'][$cid]) ? 1 : 0;
      $db->prepare("UPDATE categorias SET valor_inscricao=?,ativo=? WHERE id=?")->execute([floatval($val),$ativo,$cid]);
    }
    $msg='Categorias actualizadas!'; $msgTipo='ok'; $tab='categorias';
  }
  if ($acao==='novo_admin' && $_SESSION['admin_nivel']==='super_admin') {
    $an=$_POST['nome']??''; $ae=$_POST['email']??''; $ap=$_POST['password']??''; $anv=$_POST['nivel']??'admin';
    $db->prepare("INSERT INTO admins (nome,email,password,nivel) VALUES (?,?,?,?)")->execute([$an,$ae,password_hash($ap,PASSWORD_DEFAULT),$anv]);
    $msg='Admin criado!'; $msgTipo='ok'; $tab='admins';
  }
}

$adminActual = $db->prepare("SELECT * FROM admins WHERE id=?"); $adminActual->execute([$_SESSION['admin_id']]); $adminActual=$adminActual->fetch();
$categorias = $db->query("SELECT * FROM categorias ORDER BY idade_min")->fetchAll();
$admins     = $db->query("SELECT * FROM admins ORDER BY data_criacao DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Configurações — Admin Inter Clube</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin.css">
<style>
.tab-bar { display:flex; gap:0; border-bottom:1px solid var(--border); margin-bottom:1.5rem; }
.tab-btn { padding:.7rem 1.25rem; font-size:.8rem; font-weight:600; font-family:var(--font-d); letter-spacing:1px; color:var(--muted); background:none; border:none; cursor:pointer; border-bottom:2px solid transparent; transition:all .18s; }
.tab-btn.active { color:var(--blue); border-bottom-color:var(--blue); }
.tab-btn:hover  { color:var(--text); }
.tab-pane { display:none; } .tab-pane.active { display:block; }
</style>
</head>
<body>
<?php include '_sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="topbar-title">Configurações <small>Sistema e preferências</small></div>
  </div>
  <div class="content">

    <?php if($msg): ?>
    <div style="background:<?=$msgTipo==='ok'?'rgba(16,185,129,.12)':'rgba(239,68,68,.12)'?>;border:1px solid <?=$msgTipo==='ok'?'rgba(16,185,129,.3)':'rgba(239,68,68,.3)'?>;border-radius:8px;padding:.75rem 1rem;color:<?=$msgTipo==='ok'?'#10b981':'#ef4444'?>;margin-bottom:1.25rem;font-size:.875rem">
      <i class="fa fa-<?=$msgTipo==='ok'?'check':'exclamation'?>-circle me-2"></i><?= $msg ?>
    </div>
    <?php endif; ?>

    <div class="card">
      <div class="tab-bar">
        <button class="tab-btn <?=$tab==='perfil'?'active':''?>" onclick="showTab('perfil',this)"><i class="fa fa-user me-1"></i>Perfil</button>
        <button class="tab-btn <?=$tab==='senha'?'active':''?>"  onclick="showTab('senha',this)"><i class="fa fa-lock me-1"></i>Senha</button>
        <?php if($_SESSION['admin_nivel']==='super_admin'): ?>
        <button class="tab-btn <?=$tab==='categorias'?'active':''?>" onclick="showTab('categorias',this)"><i class="fa fa-layer-group me-1"></i>Categorias</button>
        <button class="tab-btn <?=$tab==='admins'?'active':''?>"     onclick="showTab('admins',this)"><i class="fa fa-users-cog me-1"></i>Administradores</button>
        <?php endif; ?>
      </div>

      <!-- Perfil -->
      <div class="tab-pane <?=$tab==='perfil'?'active':''?>" id="tab-perfil">
        <div class="card-body">
          <form method="POST">
            <input type="hidden" name="acao" value="perfil">
            <div class="row g-3" style="max-width:500px">
              <div class="col-12">
                <label class="ic-label">Nome</label>
                <input type="text" name="nome" class="ic-input-dark" value="<?= htmlspecialchars($adminActual['nome']) ?>" required>
              </div>
              <div class="col-12">
                <label class="ic-label">Email</label>
                <input type="email" name="email" class="ic-input-dark" value="<?= htmlspecialchars($adminActual['email']) ?>" required>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-topbar primary"><i class="fa fa-save me-1"></i>Guardar Perfil</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Senha -->
      <div class="tab-pane <?=$tab==='senha'?'active':''?>" id="tab-senha">
        <div class="card-body">
          <form method="POST">
            <input type="hidden" name="acao" value="senha">
            <div class="row g-3" style="max-width:500px">
              <div class="col-12">
                <label class="ic-label">Palavra-passe Actual</label>
                <input type="password" name="atual" class="ic-input-dark" required>
              </div>
              <div class="col-12">
                <label class="ic-label">Nova Palavra-passe</label>
                <input type="password" name="nova" class="ic-input-dark" minlength="8" required>
              </div>
              <div class="col-12">
                <label class="ic-label">Confirmar Nova</label>
                <input type="password" name="confirmar" class="ic-input-dark" required>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-topbar primary"><i class="fa fa-lock me-1"></i>Alterar Senha</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <?php if($_SESSION['admin_nivel']==='super_admin'): ?>

      <!-- Categorias -->
      <div class="tab-pane <?=$tab==='categorias'?'active':''?>" id="tab-categorias">
        <div class="card-body">
          <form method="POST">
            <input type="hidden" name="acao" value="cat">
            <div style="overflow-x:auto">
              <table class="table-dark-custom" style="width:100%">
                <thead><tr><th>Categoria</th><th>Idades</th><th>Valor (AOA)</th><th>Activo</th></tr></thead>
                <tbody>
                <?php foreach($categorias as $cat): ?>
                <tr>
                  <td style="font-weight:600"><?= htmlspecialchars($cat['nome']) ?></td>
                  <td style="color:var(--muted)"><?= $cat['idade_min'] ?>–<?= $cat['idade_max'] ?> anos</td>
                  <td><input type="number" name="valor[<?=$cat['id']?>]" class="ic-input-dark" style="width:130px" value="<?= $cat['valor_inscricao'] ?>"></td>
                  <td>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" name="ativo[<?=$cat['id']?>]" value="1" <?=$cat['ativo']?'checked':''?>>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div style="margin-top:1.25rem">
              <button type="submit" class="btn-topbar primary"><i class="fa fa-save me-1"></i>Guardar Categorias</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Admins -->
      <div class="tab-pane <?=$tab==='admins'?'active':''?>" id="tab-admins">
        <div class="card-body">
          <div style="overflow-x:auto;margin-bottom:2rem">
            <table class="table-dark-custom" style="width:100%">
              <thead><tr><th>Nome</th><th>Email</th><th>Nível</th><th>Último Login</th><th>Estado</th></tr></thead>
              <tbody>
              <?php foreach($admins as $a): ?>
              <tr>
                <td style="font-weight:600"><?= htmlspecialchars($a['nome']) ?></td>
                <td style="color:var(--muted);font-size:.82rem"><?= htmlspecialchars($a['email']) ?></td>
                <td><span class="badge-status bs-<?=$a['nivel']==='super_admin'?'aprovado':($a['nivel']==='admin'?'em_analise':'pendente')?>"><?= $a['nivel'] ?></span></td>
                <td style="color:var(--muted);font-size:.82rem"><?= $a['ultimo_login']?date('d/m/Y H:i',strtotime($a['ultimo_login'])):'—' ?></td>
                <td><span class="badge-status <?=$a['ativo']?'bs-aprovado':'bs-rejeitado'?>"><?=$a['ativo']?'Activo':'Inactivo'?></span></td>
              </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <div style="border-top:1px solid var(--border);padding-top:1.5rem">
            <h6 style="font-family:var(--font-d);letter-spacing:1px;color:var(--text);margin-bottom:1rem"><i class="fa fa-plus me-2" style="color:var(--blue)"></i>NOVO ADMINISTRADOR</h6>
            <form method="POST">
              <input type="hidden" name="acao" value="novo_admin">
              <div class="row g-3" style="max-width:600px">
                <div class="col-md-6"><label class="ic-label">Nome</label><input type="text" name="nome" class="ic-input-dark" required></div>
                <div class="col-md-6"><label class="ic-label">Email</label><input type="email" name="email" class="ic-input-dark" required></div>
                <div class="col-md-6"><label class="ic-label">Password</label><input type="password" name="password" class="ic-input-dark" minlength="8" required></div>
                <div class="col-md-6">
                  <label class="ic-label">Nível</label>
                  <select name="nivel" class="ic-input-dark">
                    <option value="editor">Editor</option>
                    <option value="admin" selected>Admin</option>
                    <option value="super_admin">Super Admin</option>
                  </select>
                </div>
                <div class="col-12"><button type="submit" class="btn-topbar primary"><i class="fa fa-user-plus me-1"></i>Criar Admin</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showTab(id,btn){
  document.querySelectorAll('.tab-pane').forEach(function(p){p.classList.remove('active');});
  document.querySelectorAll('.tab-btn').forEach(function(b){b.classList.remove('active');});
  document.getElementById('tab-'+id).classList.add('active');
  btn.classList.add('active');
}
</script>
</body></html>
