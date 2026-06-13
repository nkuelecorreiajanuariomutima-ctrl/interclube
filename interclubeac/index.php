<?php require_once 'includes/config.php';
$db = getDB();

// Buscar eventos publicados
$eventos = $db->query("SELECT * FROM eventos WHERE publicado = 1 ORDER BY destaque DESC, data_evento ASC LIMIT 6")->fetchAll();

// Buscar estatísticas
$totalAtletas = $db->query("SELECT COUNT(*) FROM candidaturas WHERE status = 'aprovado'")->fetchColumn();
$totalEventos = $db->query("SELECT COUNT(*) FROM eventos WHERE publicado = 1")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia Inter Clube - Futebol de Angola</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- NAVBAR — branco -->
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
                <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fa fa-home me-1"></i>Início</a></li>
                <li class="nav-item"><a class="nav-link" href="sobre.php"><i class="fa fa-info-circle me-1"></i>Sobre</a></li>
                <li class="nav-item"><a class="nav-link" href="eventos.php"><i class="fa fa-calendar me-1"></i>Eventos</a></li>
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

<!-- HERO — imagem de futebol com overlay azul -->
<section class="hero-section" id="hero">
    <!-- Imagem de fundo: estádio/futebol -->
    <div class="hero-bg-img"></div>
    <!-- Overlay azul escuro -->
    <div class="hero-overlay"></div>
    <!-- Brilhos suaves -->
    <div class="hero-pattern"></div>

    <div class="container hero-content">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-7">
                <div class="hero-badge mb-3">
                    <i class="fa fa-futbol me-1"></i> Academia Oficial do Inter Clube de Angola
                </div>
                <h1 class="hero-title">
                    FORMA O TEU<br>
                    <span class="text-gold">TALENTO</span><br>
                    CONNOSCO
                </h1>
                <p class="hero-desc">
                    A Academia Inter Clube é o berço dos grandes talentos do futebol angolano.
                    Com metodologia profissional, infraestrutura de excelência e treinadores qualificados,
                    formamos os campeões do futuro.
                </p>
                <div class="hero-actions d-flex flex-wrap gap-3">
                    <a href="inscricao.php" class="btn btn-gold btn-lg">
                        <i class="fa fa-futbol me-2"></i>INSCREVER AGORA
                    </a>
                    <a href="sobre.php" class="btn btn-outline-white btn-lg">
                        <i class="fa fa-play-circle me-2"></i>Saber Mais
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                
                
            </div>
        </div>
        <div class="hero-scroll">
            <a href="#stats"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="stats-bar" id="stats">
    <div class="container">
        <div class="row g-0">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <i class="fa fa-users"></i>
                    <div class="stat-num"><?= number_format($totalAtletas + 350) ?>+</div>
                    <div class="stat-label">Atletas Formados</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <i class="fa fa-trophy"></i>
                    <div class="stat-num">12+</div>
                    <div class="stat-label">Títulos Nacionais</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <i class="fa fa-layer-group"></i>
                    <div class="stat-num">8</div>
                    <div class="stat-label">Categorias</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <i class="fa fa-calendar-check"></i>
                    <div class="stat-num">45</div>
                    <div class="stat-label">Anos de História</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- INSCRIÇÃO RÁPIDA -->
<section class="section-quick-verify py-5 bg-dark-alt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-4">
                <span class="section-tag">PORTAL DO ATLETA</span>
                <h2 class="section-title text-white">Verifica a Tua Candidatura</h2>
                <p class="text-muted">Consulta o estado da tua inscrição usando o teu email ou número do Bilhete de Identidade</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="verify-card">
                    <div class="verify-tabs d-flex mb-4" id="verifyTabs">
                        <button class="verify-tab active" data-tab="email">
                            <i class="fa fa-envelope me-2"></i>Por Email
                        </button>
                        <button class="verify-tab" data-tab="bi">
                            <i class="fa fa-id-card me-2"></i>Por Nº BI
                        </button>
                    </div>
                    <div id="tab-email">
                        <input type="email" class="form-control ic-input mb-3" id="checkEmail" placeholder="O teu endereço de email">
                        <button class="btn btn-gold w-100" onclick="verificarCandidatura('email')">
                            <i class="fa fa-search me-2"></i>Verificar Estado
                        </button>
                    </div>
                    <div id="tab-bi" style="display:none">
                        <input type="text" class="form-control ic-input mb-3" id="checkBI" placeholder="Número do Bilhete de Identidade">
                        <button class="btn btn-gold w-100" onclick="verificarCandidatura('bi')">
                            <i class="fa fa-search me-2"></i>Verificar Estado
                        </button>
                    </div>
                    <div id="verifyResult" class="mt-3"></div>
                    <div class="text-center mt-3">
                        <a href="verificar.php" class="text-gold small">Página completa de verificação →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIAS -->
<section class="section-categorias py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">FORMAÇÃO</span>
            <h2 class="section-title">Categorias de Formação</h2>
            <p class="text-muted">Do primeiro toque ao profissionalismo, temos uma categoria para cada fase do desenvolvimento</p>
        </div>
        <div class="row g-3">
            <?php
            $cats = [
                ['Petizes','5-7 anos','fa-child','#e74c3c'],
                ['Traquinas','8-9 anos','fa-running','#e67e22'],
                ['Benjamins','10-11 anos','fa-star','#f1c40f'],
                ['Infantis','12-13 anos','fa-bolt','#2ecc71'],
                ['Iniciados','14-15 anos','fa-fire','#1abc9c'],
                ['Juvenis','16-17 anos','fa-medal','#3498db'],
                ['Juniores','18-20 anos','fa-award','#9b59b6'],
                ['Seniores','21+ anos','fa-crown','#c0392b'],
            ];
            foreach($cats as $i => $cat): ?>
            <div class="col-6 col-md-3">
                <div class="cat-card" style="--cat-color: <?= $cat[3] ?>">
                    <i class="fa <?= $cat[2] ?> cat-icon"></i>
                    <h5><?= $cat[0] ?></h5>
                    <span><?= $cat[1] ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="inscricao.php" class="btn btn-ic-primary btn-lg">
                <i class="fa fa-futbol me-2"></i>Fazer Inscrição
            </a>
        </div>
    </div>
</section>

<!-- EVENTOS -->
<?php if (!empty($eventos)): ?>
<section class="section-eventos py-5 bg-dark-alt">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <span class="section-tag">NOTÍCIAS</span>
                <h2 class="section-title text-white mb-0">Eventos & Notícias</h2>
            </div>
            <a href="eventos.php" class="btn btn-outline-gold">Ver Todos</a>
        </div>
        <div class="row g-4">
            <?php foreach($eventos as $ev): ?>
            <div class="col-md-4">
                <div class="evento-card">
                    <div class="evento-date">
                        <span class="ev-day"><?= date('d', strtotime($ev['data_evento'])) ?></span>
                        <span class="ev-month"><?= strtoupper(date('M', strtotime($ev['data_evento']))) ?></span>
                    </div>
                    <?php if($ev['destaque']): ?><div class="evento-badge">Destaque</div><?php endif; ?>
                    <div class="evento-body">
                        <h5><?= htmlspecialchars($ev['titulo']) ?></h5>
                        <p><?= htmlspecialchars(substr($ev['descricao'], 0, 100)) ?>...</p>
                        <div class="evento-meta">
                            <span><i class="fa fa-map-marker-alt me-1"></i><?= htmlspecialchars($ev['local_evento']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="section-cta py-5">
    <div class="container text-center">
        <div class="cta-box">
            <i class="fa fa-futbol cta-icon"></i>
            <h2>Pronto para Começar a Tua Jornada?</h2>
            <p>As inscrições estão abertas! Junta-te à família Inter Clube e dá o primeiro passo rumo ao profissionalismo.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="inscricao.php" class="btn btn-gold btn-lg">
                    <i class="fa fa-pen me-2"></i>Inscrever Agora
                </a>
                <a href="contactos.php" class="btn btn-outline-light btn-lg">
                    <i class="fa fa-phone me-2"></i>Falar Connosco
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
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
