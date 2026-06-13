<?php
require_once '../includes/config.php';
if (session_status()===PHP_SESSION_NONE) session_start();
if (isset($_SESSION['admin_id'])) { header('Location: dashboard.php'); exit; }

$erro = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    $db    = getDB();
    $stmt  = $db->prepare("SELECT * FROM admins WHERE email=? AND ativo=1 LIMIT 1");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($pass, $admin['password'])) {
        $_SESSION['admin_id']    = $admin['id'];
        $_SESSION['admin_nome']  = $admin['nome'];
        $_SESSION['admin_nivel'] = $admin['nivel'];
        $db->prepare("UPDATE admins SET ultimo_login=NOW() WHERE id=?")->execute([$admin['id']]);
        header('Location: dashboard.php'); exit;
    }
    $erro = 'Email ou palavra-passe incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Admin Inter Clube</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login-wrap">
  <div class="login-card">
    <div class="login-logo">
      <img src="../img/2431_imgbank_1693590779.png"  width="70px" alt="">
      <h4>INTER CLUBE</h4>
      <p>Painel Administrativo</p>
    </div>

    <?php if($erro): ?>
    <div class="alert-login"><i class="fa fa-exclamation-circle me-2"></i><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="ic-label">Email</label>
        <div style="position:relative">
          <i class="fa fa-envelope" style="position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.85rem"></i>
          <input type="email" name="email" class="ic-input-dark" style="padding-left:2.5rem" placeholder="admin@interclubeac.ao" required value="<?= htmlspecialchars($_POST['email']??'') ?>">
        </div>
      </div>
      <div class="mb-4">
        <label class="ic-label">Palavra-passe</label>
        <div style="position:relative">
          <i class="fa fa-lock" style="position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.85rem"></i>
          <input type="password" name="password" id="pwdField" class="ic-input-dark" style="padding-left:2.5rem;padding-right:2.5rem" placeholder="••••••••" required>
          <button type="button" onclick="togglePwd()" style="position:absolute;right:.9rem;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--muted);cursor:pointer;padding:0">
            <i class="fa fa-eye" id="eyeIcon"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-login">ENTRAR</button>
    </form>

    <div style="text-align:center;margin-top:1.5rem">
      <a href="../index.php" style="color:var(--muted);font-size:.8rem;text-decoration:none">
        <i class="fa fa-arrow-left me-1"></i>Voltar ao site
      </a>
    </div>
  </div>
</div>
<script>
function togglePwd(){
  var f=document.getElementById('pwdField'), i=document.getElementById('eyeIcon');
  if(f.type==='password'){f.type='text';i.className='fa fa-eye-slash';}
  else{f.type='password';i.className='fa fa-eye';}
}
</script>
</body>
</html>
