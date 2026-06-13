<?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - Academia Inter Clube</title>
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
                <li class="nav-item"><a class="nav-link " href="eventos.php"><i class="fa fa-calendar me-1"></i>Eventos</a></li>
                <li class="nav-item"><a class="nav-link active" href="contactos.php"><i class="fa fa-phone me-1"></i>Contactos</a></li>
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
                <li class="breadcrumb-item active">Contactos</li>
            </ol>
        </nav>
        <h1><i class="fa fa-phone me-3 text-gold"></i>CONTACTOS</h1>
        <p class="text-muted">Estamos aqui para ajudar. Fala connosco!</p>
    </div>
</div>

<section class="form-section py-5">
<div class="container">
    <div class="row g-5">
        <div class="col-lg-5">
            <span class="section-tag">FALE CONNOSCO</span>
            <h2 class="section-title">Informações de Contacto</h2>
            <p class="text-muted mb-4">Tem dúvidas sobre inscrições, categorias ou qualquer outro assunto? Entre em contacto connosco.</p>

            <div class="contact-info-card">
                <div class="contact-icon"><i class="fa fa-map-marker-alt"></i></div>
                <div>
                    <h6>MORADA</h6>
                    <p>Estádio 11 de Novembro, Camama<br>Luanda, Angola</p>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-icon"><i class="fa fa-phone"></i></div>
                <div>
                    <h6>TELEFONES</h6>
                    <p>+244 923 456 789 (Principal)<br>+244 912 345 678 (Secretaria)</p>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-icon"><i class="fa fa-envelope"></i></div>
                <div>
                    <h6>EMAIL</h6>
                    <p>geral@interclubeac.ao<br>inscricoes@interclubeac.ao</p>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-icon"><i class="fa fa-clock"></i></div>
                <div>
                    <h6>HORÁRIO DE ATENDIMENTO</h6>
                    <p>Segunda a Sexta: 08h00 - 18h00<br>Sábado: 09h00 - 13h00</p>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="footer-heading">REDES SOCIAIS</h6>
                <div class="d-flex gap-2">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="fa fa-paper-plane"></i>
                    <h4>ENVIAR MENSAGEM</h4>
                </div>
                <div class="form-card-body">
                    <div id="contactAlert"></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nome Completo *</label>
                            <input type="text" class="form-control ic-input" id="c_nome" placeholder="Seu nome completo">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control ic-input" id="c_email" placeholder="seu@email.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telefone</label>
                            <input type="tel" class="form-control ic-input" id="c_tel" placeholder="+244 9XX XXX XXX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Assunto *</label>
                            <select class="form-control ic-input" id="c_assunto">
                                <option value="">Selecionar...</option>
                                <option value="Informações sobre Inscrições">Informações sobre Inscrições</option>
                                <option value="Verificação de Candidatura">Verificação de Candidatura</option>
                                <option value="Informações sobre Categorias">Informações sobre Categorias</option>
                                <option value="Pagamentos e Mensalidades">Pagamentos e Mensalidades</option>
                                <option value="Eventos e Torneios">Eventos e Torneios</option>
                                <option value="Parcerias">Parcerias</option>
                                <option value="Outro">Outro Assunto</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mensagem *</label>
                            <textarea class="form-control ic-input" id="c_mensagem" rows="5" placeholder="Escreva a sua mensagem aqui..."></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-ic-primary btn-lg w-100" onclick="enviarContacto()">
                                <i class="fa fa-paper-plane me-2"></i>ENVIAR MENSAGEM
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mapa -->
            <div class="mapa-embed mt-4" style="height:300px; background: var(--ic-dark2); display:flex; align-items:center; justify-content:center; border-radius:10px;">
                <div class="text-center text-muted">
                    <i class="fa fa-map-marked-alt fa-3x mb-3 text-red" style="color:var(--ic-red)"></i>
                    <p>Estádio 11 de Novembro, Luanda</p>
                    <a href="https://maps.google.com/?q=Estadio+11+de+Novembro+Luanda+Angola" target="_blank" class="btn btn-outline-gold btn-sm">
                        <i class="fa fa-map-marker-alt me-2"></i>Ver no Google Maps
                    </a>
                </div>
            </div>
        </div>
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
<script>
async function enviarContacto() {
    const nome = document.getElementById('c_nome').value.trim();
    const email = document.getElementById('c_email').value.trim();
    const assunto = document.getElementById('c_assunto').value;
    const mensagem = document.getElementById('c_mensagem').value.trim();
    
    if (!nome || !email || !assunto || !mensagem) {
        document.getElementById('contactAlert').innerHTML = '<div class="alert-ic alert-ic-error p-3 rounded mb-3">Preencha todos os campos obrigatórios.</div>';
        return;
    }

    const btn = event.target;
    btn.innerHTML = '<span class="spinner-ic"></span> A enviar...';
    btn.disabled = true;

    try {
        const res = await fetch('api/contacto.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({nome, email, telefone: document.getElementById('c_tel').value, assunto, mensagem})
        });
        const data = await res.json();
        
        if (data.success) {
            document.getElementById('contactAlert').innerHTML = '<div class="alert-ic alert-ic-success p-3 rounded mb-3"><i class="fa fa-check-circle me-2"></i>Mensagem enviada com sucesso! Responderemos em breve.</div>';
            ['c_nome','c_email','c_tel','c_mensagem'].forEach(id => document.getElementById(id).value = '');
            document.getElementById('c_assunto').value = '';
        } else {
            document.getElementById('contactAlert').innerHTML = '<div class="alert-ic alert-ic-error p-3 rounded mb-3">Erro ao enviar. Por favor tenta novamente.</div>';
        }
    } catch(e) {
        document.getElementById('contactAlert').innerHTML = '<div class="alert-ic alert-ic-error p-3 rounded mb-3">Erro de ligação. Por favor tenta novamente.</div>';
    }
    
    btn.innerHTML = '<i class="fa fa-paper-plane me-2"></i>ENVIAR MENSAGEM';
    btn.disabled = false;
}
</script>
</body>
</html>
