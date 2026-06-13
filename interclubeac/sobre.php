<?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Academia Inter Clube</title>
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
                <li class="nav-item"><a class="nav-link active" href="sobre.php"><i class="fa fa-info-circle me-1"></i>Sobre</a></li>
                <li class="nav-item"><a class="nav-link " href="eventos.php"><i class="fa fa-calendar me-1"></i>Eventos</a></li>
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
        <h1><i class="fa fa-info-circle me-3 text-gold"></i>SOBRE A ACADEMIA</h1>
        <p class="text-muted">Conheça a história e missão da Academia Inter Clube</p>
    </div>
</div>

<section class="form-section py-5">
<div class="container">
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-6">
            <span class="section-tag">QUEM SOMOS</span>
            <h2 class="section-title">A Academia Inter Clube</h2>
            <p class="text-muted">A Academia de Futebol Inter Clube é o projeto de formação do histórico Inter Clube de Angola. Fundada com o objetivo de desenvolver jovens talentos angolanos, a Academia é hoje uma referência no futebol de formação em Angola.</p>
            <p class="text-muted">Com instalações modernas, corpo técnico altamente qualificado e uma metodologia de treino adaptada às diferentes faixas etárias, a Academia Inter Clube garante o desenvolvimento integral dos seus atletas, tanto no plano desportivo como humano.</p>
            <div class="row g-3 mt-3">
                <div class="col-6">
                    <div class="p-3 rounded" style="background:rgba(204,0,0,0.1);border:1px solid rgba(204,0,0,0.2)">
                        <div style="font-family:var(--font-display);font-size:2rem;color:var(--ic-gold)">1979</div>
                        <div class="text-muted small">Ano de Fundação</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded" style="background:rgba(204,0,0,0.1);border:1px solid rgba(204,0,0,0.2)">
                        <div style="font-family:var(--font-display);font-size:2rem;color:var(--ic-gold)">8</div>
                        <div class="text-muted small">Categorias Activas</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="p-4 rounded" style="background:var(--ic-dark2);border:1px solid var(--ic-border)">
                <h5 style="font-family:var(--font-display);color:var(--ic-gold);letter-spacing:2px">MISSÃO & VISÃO</h5>
                <div class="mb-3">
                    <h6 class="text-white">Nossa Missão</h6>
                    <p class="text-muted small">Formar atletas de excelência através de um programa integrado de desenvolvimento desportivo, educacional e humano, contribuindo para o crescimento do futebol angolano.</p>
                </div>
                <div class="mb-3">
                    <h6 class="text-white">Nossa Visão</h6>
                    <p class="text-muted small">Ser a principal academia de futebol de Angola, reconhecida pela qualidade da formação e pelo número de talentos que contribui para o futebol nacional e internacional.</p>
                </div>
                <div>
                    <h6 class="text-white">Nossos Valores</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <?php foreach(['Disciplina','Respeito','Dedicação','Fair Play','Excelência','União'] as $v): ?>
                        <span style="background:rgba(204,0,0,0.15);border:1px solid rgba(204,0,0,0.3);color:var(--ic-red-light);padding:0.25rem 0.75rem;border-radius:4px;font-size:0.75rem;font-family:var(--font-display);letter-spacing:1px"><?= $v ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff -->
    <div class="text-center mb-4">
        <span class="section-tag">EQUIPA TÉCNICA</span>
        <h2 class="section-title">O Nosso Staff</h2>
    </div>
    <div class="row g-4 mb-5">
        <?php
        $staff = [
            ['Director Técnico', 'Manuel Carvalho', 'fa-user-tie'],
            ['Coordenador de Formação', 'António Silva', 'fa-chalkboard-teacher'],
            ['Treinador Sénior', 'Carlos Mendes', 'fa-whistle'],
            ['Preparador Físico', 'João Pereira', 'fa-running'],
        ];
        foreach($staff as $s): ?>
        <div class="col-6 col-md-3">
            <div class="text-center p-3" style="background:var(--ic-dark2);border:1px solid var(--ic-border);border-radius:10px">
                <div style="width:60px;height:60px;background:linear-gradient(135deg,var(--ic-red-dark),var(--ic-red));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem">
                    <i class="fa <?= $s[2] ?> text-white" style="font-size:1.5rem"></i>
                </div>
                <h6 style="font-family:var(--font-display);color:#fff;font-size:0.9rem"><?= $s[1] ?></h6>
                <p class="text-muted small mb-0"><?= $s[0] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center">
        <a href="inscricao.php" class="btn btn-gold btn-lg">
            <i class="fa fa-futbol me-2"></i>Inscrever na Academia
        </a>
    </div>
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
