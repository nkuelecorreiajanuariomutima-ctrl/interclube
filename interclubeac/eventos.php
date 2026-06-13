<?php require_once 'includes/config.php';
$db = getDB();
$eventos = $db->query("SELECT * FROM eventos WHERE publicado = 1 ORDER BY data_evento ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - Academia Inter Clube</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <div class="logo">
              <img src="img/2431_imgbank_1693590779.png"  width="70px" alt="">
            </div>
            <div class="logo-text">
                <span class="logo-main">INTER CLUBE</span>
                <span class="logo-sub">Academia de Futebol</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link " href="index.php"><i class="fa fa-home me-1"></i>Início</a></li>
                <li class="nav-item"><a class="nav-link" href="sobre.php"><i class="fa fa-info-circle me-1"></i>Sobre</a></li>
                <li class="nav-item"><a class="nav-link active" href="eventos.php"><i class="fa fa-calendar me-1"></i>Eventos</a></li>
                <li class="nav-item"><a class="nav-link" href="contactos.php"><i class="fa fa-phone me-1"></i>Contactos</a></li>
                <li class="nav-item"><a class="nav-link" href="verificar.php"><i class="fa fa-search me-1"></i>Verificar</a></li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-ic-primary" href="inscricao.php">
                       Inscrever Agora
                    </a>
                    <a class="btn btn-ic-primary" href="admin/">
                       Área administrativa
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Início</a></li>
                <li class="breadcrumb-item active">Eventos</li>
            </ol>
        </nav>
        <h1><i class="fa fa-calendar me-3 text-gold"></i>EVENTOS & NOTÍCIAS</h1>
        <p class="text-muted">Fique a par de todas as actividades da Academia Inter Clube</p>
    </div>
</div>

<section class="form-section py-5">
<div class="container">
    <?php if(empty($eventos)): ?>
    <div class="text-center text-muted py-5">
        <i class="fa fa-calendar fa-3x mb-3" style="color:var(--ic-red)"></i>
        <p>Nenhum evento publicado de momento. Fique atento!</p>
    </div>
    <?php else: ?>
    <div class="row g-4">
        <?php foreach($eventos as $ev): ?>
        <div class="col-md-6 col-lg-4">
            <div class="evento-card h-100">
                <div class="evento-date">
                    <span class="ev-day"><?= date('d', strtotime($ev['data_evento'])) ?></span>
                    <span class="ev-month"><?= strtoupper(date('M', strtotime($ev['data_evento']))) ?></span>
                </div>
                <?php if($ev['destaque']): ?><div class="evento-badge"><i class="fa fa-star me-1"></i>Destaque</div><?php endif; ?>
                <div class="evento-body">
                    <h5><?= htmlspecialchars($ev['titulo']) ?></h5>
                    <p class="mb-2"><?= htmlspecialchars($ev['descricao']) ?></p>
                    <?php if($ev['local_evento']): ?>
                    <div class="evento-meta mb-1"><i class="fa fa-map-marker-alt me-1"></i><?= htmlspecialchars($ev['local_evento']) ?></div>
                    <?php endif; ?>
                    <?php if($ev['hora_evento']): ?>
                    <div class="evento-meta"><i class="fa fa-clock me-1"></i><?= date('H:i', strtotime($ev['hora_evento'])) ?>h</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row g-4 py-5">
            <div class="col-lg-4">
                <div class="footer-brand d-flex align-items-center gap-2 mb-3">
                    <img src="img/2431_imgbank_1693590779.png" width="55px" alt="">
                    <div>
                        <div class="fw-bold text-white">INTER CLUBE</div>
                        <div class="text-muted small">Academia de Futebol</div>
                    </div>
                </div>
                <p class="text-muted small">Formando os campeões do futebol angolano desde 1979. Comprometidos com a excelência, disciplina e desenvolvimento integral dos nossos atletas.</p>
                <div class="social-links d-flex gap-2 mt-3">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="footer-heading">Links</h6>
                <ul class="footer-links">
                    <li><a href="index.php">Início</a></li>
                    <li><a href="sobre.php">Sobre Nós</a></li>
                    <li><a href="eventos.php">Eventos</a></li>
                    <li><a href="contactos.php">Contactos</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="footer-heading">Atletas</h6>
                <ul class="footer-links">
                    <li><a href="inscricao.php">Inscrição</a></li>
                    <li><a href="verificar.php">Verificar</a></li>
                    <li><a href="inscricao.php#categorias">Categorias</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="footer-heading">Contactos</h6>
                <ul class="footer-contact">
                    <li><i class="fa fa-map-marker-alt"></i>Estádio 11 de Novembro, Luanda, Angola</li>
                    <li><i class="fa fa-phone"></i>+244 923 456 789</li>
                    <li><i class="fa fa-phone"></i>+244 912 345 678</li>
                    <li><i class="fa fa-envelope"></i>geral@interclubeac.ao</li>
                    <li><i class="fa fa-clock"></i>Seg-Sex: 08h - 18h</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 text-muted small">
                    &copy; <?= date('Y') ?> Academia Inter Clube. Todos os direitos reservados.
                </div>
                <div class="col-md-6 text-md-end text-muted small">
                    Desenvolvido para o Clube de Angola 🇦🇴
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
