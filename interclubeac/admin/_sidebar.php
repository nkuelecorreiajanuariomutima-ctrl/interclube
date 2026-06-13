<?php
$page = basename($_SERVER['PHP_SELF'], '.php');
$admin_nome = $_SESSION['admin_nome'] ?? 'Admin';
$admin_ini  = strtoupper(substr($admin_nome,0,1));
?>
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-badge-sm">IC</div>
    <div class="sidebar-brand">
      <strong>INTER CLUBE</strong>
      <small>Painel Administrativo</small>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section">Principal</div>
    <a href="dashboard.php"    class="nav-item <?= $page==='dashboard'?'active':'' ?>"><i class="fa fa-chart-line"></i>Dashboard</a>
    <a href="candidaturas.php" class="nav-item <?= $page==='candidaturas'||$page==='candidatura_detalhe'?'active':'' ?>">
      <i class="fa fa-users"></i>Candidaturas
      <?php
        $db2=getDB();
        $pend=$db2->query("SELECT COUNT(*) FROM candidaturas WHERE status IN ('pendente','pagamento_pendente','em_analise')")->fetchColumn();
        if($pend>0) echo '<span class="badge">'.$pend.'</span>';
      ?>
    </a>

    <div class="nav-section">Conteúdo</div>
    <a href="eventos.php"   class="nav-item <?= $page==='eventos'?'active':'' ?>"><i class="fa fa-calendar-alt"></i>Eventos</a>
    <a href="contactos.php" class="nav-item <?= $page==='contactos'?'active':'' ?>">
      <i class="fa fa-envelope"></i>Mensagens
      <?php
        $unread=$db2->query("SELECT COUNT(*) FROM contactos WHERE lido=0")->fetchColumn();
        if($unread>0) echo '<span class="badge">'.$unread.'</span>';
      ?>
    </a>

    <div class="nav-section">Sistema</div>
    <a href="configuracoes.php" class="nav-item <?= $page==='configuracoes'?'active':'' ?>"><i class="fa fa-cog"></i>Configurações</a>
    <a href="../index.php" target="_blank" class="nav-item"><i class="fa fa-external-link-alt"></i>Ver Site</a>
  </nav>

  <div class="sidebar-footer">
    <div class="admin-avatar"><?= $admin_ini ?></div>
    <div class="admin-info">
      <strong><?= htmlspecialchars($admin_nome) ?></strong>
      <small><?= $_SESSION['admin_nivel'] ?? 'admin' ?></small>
    </div>
    <a href="logout.php" class="btn-logout" title="Sair"><i class="fa fa-sign-out-alt"></i></a>
  </div>
</aside>
