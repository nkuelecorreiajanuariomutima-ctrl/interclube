<?php
require_once '../includes/config.php';
requireAdmin();
$db = getDB();

$stats = [
  'total'      => $db->query("SELECT COUNT(*) FROM candidaturas")->fetchColumn(),
  'pendentes'  => $db->query("SELECT COUNT(*) FROM candidaturas WHERE status IN ('pendente','pagamento_pendente')")->fetchColumn(),
  'analise'    => $db->query("SELECT COUNT(*) FROM candidaturas WHERE status='em_analise'")->fetchColumn(),
  'aprovados'  => $db->query("SELECT COUNT(*) FROM candidaturas WHERE status='aprovado'")->fetchColumn(),
  'rejeitados' => $db->query("SELECT COUNT(*) FROM candidaturas WHERE status='rejeitado'")->fetchColumn(),
  'eventos'    => $db->query("SELECT COUNT(*) FROM eventos")->fetchColumn(),
  'mensagens'  => $db->query("SELECT COUNT(*) FROM contactos WHERE lido=0")->fetchColumn(),
];
$ultimas = $db->query("SELECT * FROM candidaturas ORDER BY data_candidatura DESC LIMIT 8")->fetchAll();
$statusLabel = ['pendente'=>'Pendente','pagamento_pendente'=>'Pag. Pendente','em_analise'=>'Em Análise','aprovado'=>'Aprovado','rejeitado'=>'Rejeitado'];
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — Admin Inter Clube</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php include '_sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="topbar-title">Dashboard <small>Bem-vindo, <?= htmlspecialchars($_SESSION['admin_nome']??'Admin') ?></small></div>
    <a href="candidaturas.php" class="btn-topbar ghost"><i class="fa fa-users me-1"></i>Candidaturas</a>
    <a href="eventos.php" class="btn-topbar primary"><i class="fa fa-plus me-1"></i>Novo Evento</a>
  </div>
  <div class="content">

    <!-- KPIs -->
    <div class="kpi-grid">
      <div class="kpi blue">
        <div class="kpi-icon"><i class="fa fa-users"></i></div>
        <div><div class="kpi-num"><?= $stats['total'] ?></div><div class="kpi-label">Total Candidaturas</div></div>
      </div>
      <div class="kpi yellow">
        <div class="kpi-icon"><i class="fa fa-clock"></i></div>
        <div><div class="kpi-num"><?= $stats['pendentes'] ?></div><div class="kpi-label">Pendentes</div></div>
      </div>
      <div class="kpi purple">
        <div class="kpi-icon"><i class="fa fa-hourglass-half"></i></div>
        <div><div class="kpi-num"><?= $stats['analise'] ?></div><div class="kpi-label">Em Análise</div></div>
      </div>
      <div class="kpi green">
        <div class="kpi-icon"><i class="fa fa-check-circle"></i></div>
        <div><div class="kpi-num"><?= $stats['aprovados'] ?></div><div class="kpi-label">Aprovados</div></div>
      </div>
    </div>

    <div class="row g-4">
      <!-- Tabela últimas candidaturas -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header-bar">
            <h6><i class="fa fa-list me-2" style="color:var(--blue)"></i>ÚLTIMAS CANDIDATURAS</h6>
            <a href="candidaturas.php" class="btn-topbar ghost" style="font-size:.75rem;padding:.35rem .9rem">Ver todas</a>
          </div>
          <div style="overflow-x:auto">
            <table class="table-dark-custom" style="width:100%">
              <thead><tr>
                <th>RUP</th><th>Nome</th><th>Categoria</th><th>Estado</th><th>Data</th><th></th>
              </tr></thead>
              <tbody>
              <?php foreach($ultimas as $c): ?>
              <tr>
                <td><span class="rup-cell"><?= htmlspecialchars($c['rup']) ?></span></td>
                <td style="font-weight:600"><?= htmlspecialchars($c['nome_completo']) ?></td>
                <td style="color:var(--muted)"><?= htmlspecialchars($c['categoria']) ?></td>
                <td><span class="badge-status bs-<?= $c['status'] ?>"><?= $statusLabel[$c['status']]??$c['status'] ?></span></td>
                <td style="color:var(--muted);font-size:.82rem"><?= date('d/m/Y',strtotime($c['data_candidatura'])) ?></td>
                <td><a href="candidatura_detalhe.php?id=<?= $c['id'] ?>" class="btn-act view"><i class="fa fa-eye"></i></a></td>
              </tr>
              <?php endforeach; ?>
              <?php if(empty($ultimas)): ?>
              <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--muted)">Sem candidaturas</td></tr>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Estatísticas laterais -->
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-header-bar"><h6><i class="fa fa-chart-pie me-2" style="color:var(--blue)"></i>RESUMO</h6></div>
          <div class="card-body">
            <?php
            $items=[
              ['Aprovados',$stats['aprovados'],'green',($stats['total']?round($stats['aprovados']/$stats['total']*100):0)],
              ['Em Análise',$stats['analise'],'purple',($stats['total']?round($stats['analise']/$stats['total']*100):0)],
              ['Pendentes',$stats['pendentes'],'yellow',($stats['total']?round($stats['pendentes']/$stats['total']*100):0)],
              ['Rejeitados',$stats['rejeitados'],'red',($stats['total']?round($stats['rejeitados']/$stats['total']*100):0)],
            ];
            $colors=['green'=>'#10b981','purple'=>'#8b5cf6','yellow'=>'#f59e0b','red'=>'#ef4444'];
            foreach($items as $it): ?>
            <div style="margin-bottom:1rem">
              <div style="display:flex;justify-content:space-between;margin-bottom:.3rem">
                <span style="font-size:.8rem;color:var(--muted)"><?= $it[0] ?></span>
                <span style="font-size:.8rem;font-weight:700;color:var(--text)"><?= $it[1] ?></span>
              </div>
              <div style="background:var(--bg3);border-radius:20px;height:6px;overflow:hidden">
                <div style="height:100%;width:<?= $it[3] ?>%;background:<?= $colors[$it[2]] ?>;border-radius:20px;transition:width .5s"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem">
              <a href="eventos.php" style="text-decoration:none">
                <div style="background:var(--bg3);border-radius:8px;padding:1rem;text-align:center;transition:background .2s" onmouseover="this.style.background='var(--bg4)'" onmouseout="this.style.background='var(--bg3)'">
                  <i class="fa fa-calendar-alt" style="font-size:1.5rem;color:var(--blue);display:block;margin-bottom:.5rem"></i>
                  <div style="font-family:var(--font-d);font-size:1.4rem;color:var(--text)"><?= $stats['eventos'] ?></div>
                  <div style="font-size:.72rem;color:var(--muted)">Eventos</div>
                </div>
              </a>
              <a href="contactos.php" style="text-decoration:none">
                <div style="background:var(--bg3);border-radius:8px;padding:1rem;text-align:center;transition:background .2s" onmouseover="this.style.background='var(--bg4)'" onmouseout="this.style.background='var(--bg3)'">
                  <i class="fa fa-envelope" style="font-size:1.5rem;color:var(--warning);display:block;margin-bottom:.5rem"></i>
                  <div style="font-family:var(--font-d);font-size:1.4rem;color:var(--text)"><?= $stats['mensagens'] ?></div>
                  <div style="font-size:.72rem;color:var(--muted)">Mensagens</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
