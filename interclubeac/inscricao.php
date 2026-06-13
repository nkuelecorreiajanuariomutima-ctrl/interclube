<?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscrição - Academia Inter Clube</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>
.step-nav{display:flex;margin-bottom:2rem;border-radius:10px;overflow:hidden;border:1px solid #dee2e6}
.sn{flex:1;padding:.75rem;text-align:center;font-size:.78rem;font-weight:600;font-family:'Oswald',sans-serif;letter-spacing:1px;background:#f8f9fa;color:#6c757d;border-right:1px solid #dee2e6}
.sn:last-child{border-right:none}.sn.active{background:#0d6efd;color:#fff}.sn.done{background:#cfe2ff;color:#0d6efd}
.card-form{background:#fff;border-radius:12px;border:1px solid #dee2e6;padding:2rem;box-shadow:0 2px 12px rgba(0,0,0,.06)}
.form-label{font-weight:600;font-size:.85rem;color:#374151;margin-bottom:.35rem}
.form-control,.form-select{border-radius:8px;border:1.5px solid #dee2e6;padding:.6rem .9rem;font-size:.9rem;transition:border-color .2s}
.form-control:focus,.form-select:focus{border-color:#0d6efd;box-shadow:0 0 0 3px rgba(13,110,253,.12)}
.is-invalid{border-color:#dc3545!important;box-shadow:0 0 0 3px rgba(220,53,69,.1)!important}
.invalid-feedback{display:none;font-size:.78rem;color:#dc3545;margin-top:.25rem}
.is-invalid~.invalid-feedback,.is-invalid+.invalid-feedback{display:block}
.cat-box{background:#cfe2ff;border:1.5px solid #0d6efd;border-radius:8px;padding:.6rem .9rem;font-weight:700;color:#0d6efd;font-family:'Oswald',sans-serif;font-size:1rem;min-height:42px;display:flex;align-items:center}
.btn-prim{background:#0d6efd;border:none;border-radius:8px;font-family:'Oswald',sans-serif;letter-spacing:1px;padding:.6rem 1.5rem;color:#fff;cursor:pointer}
.btn-prim:hover{background:#0b5ed7}.btn-sec{background:#f8f9fa;border:1px solid #dee2e6;border-radius:8px;font-family:'Oswald',sans-serif;letter-spacing:1px;padding:.6rem 1.5rem;color:#374151;cursor:pointer}
.btn-sec:hover{background:#e9ecef}
.sec-title{font-family:'Oswald',sans-serif;font-size:.75rem;letter-spacing:2px;color:#0d6efd;text-transform:uppercase;border-bottom:1px solid #dee2e6;padding-bottom:.4rem;margin:1rem 0}
.alert-err{background:#fff5f5;border:1px solid #fecaca;border-left:4px solid #dc3545;border-radius:8px;padding:.85rem 1rem;color:#991b1b;font-size:.875rem;margin-bottom:1rem}
.rup-box{background:#cfe2ff;border:2px solid #0d6efd;border-radius:12px;padding:1.25rem;text-align:center;margin-bottom:1rem}
.rup-code{font-family:'Oswald',sans-serif;font-size:1.8rem;color:#0d6efd;letter-spacing:3px}
</style>
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
                <li class="nav-item"><a class="nav-link" href="contactos.php"><i class="fa fa-phone me-1"></i>Contactos</a></li>
                <li class="nav-item"><a class="nav-link" href="verificar.php"><i class="fa fa-search me-1"></i>Verificar</a></li>
                <li class="nav-item ms-lg-2">
                   
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
    <h1><i class="fa fa-futbol me-3"></i>INSCRIÇÃO DE ATLETA</h1>
    <p style="color:rgba(255,255,255,.75);margin:0">Preencha os dados em 4 passos simples</p>
  </div>
</div>

<section style="background:#f1f5f9;padding:2.5rem 0 4rem">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8">

  <div class="step-nav">
    <div class="sn active" id="sn1">1 · PESSOAL</div>
    <div class="sn" id="sn2">2 · CONTACTOS</div>
    <div class="sn" id="sn3">3 · DESPORTO</div>
    <div class="sn" id="sn4">4 · PAGAMENTO</div>
  </div>

  <div id="alertBox" class="alert-err" style="display:none">
    <i class="fa fa-exclamation-circle me-2"></i><span id="alertMsg"></span>
  </div>

  <!-- PASSO 1 -->
  <div id="p1" class="card-form">
    <h5 style="font-family:'Oswald',sans-serif;color:#0d6efd;margin-bottom:1.5rem"><i class="fa fa-user me-2"></i>DADOS PESSOAIS</h5>
    <div class="row g-3">
      <div class="col-md-8">
        <label class="form-label">Nome Completo *</label>
        <input type="text" class="form-control" id="nome_completo" placeholder="Nome completo">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Nº BI *</label>
        <input type="text" class="form-control" id="bi" placeholder="005123456LA041">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Data de Nascimento *</label>
        <input type="date" class="form-control" id="data_nascimento">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Categoria</label>
        <div class="cat-box" id="catBox"><span style="color:#6c757d;font-weight:400;font-size:.82rem">Automático</span></div>
        <input type="hidden" id="categoria">
        <input type="hidden" id="valor_inscricao">
        <div class="invalid-feedback" id="e_cat">Selecione a data de nascimento</div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Género *</label>
        <select class="form-select" id="genero">
          <option value="">Selecionar...</option>
          <option value="M">Masculino</option>
          <option value="F">Feminino</option>
        </select>
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-12"><p class="sec-title">Morada</p></div>
      <div class="col-md-4">
        <label class="form-label">Província *</label>
        <select class="form-select" id="provincia">
          <option value="">Selecionar...</option>
          <option>Luanda</option><option>Bengo</option><option>Benguela</option><option>Bié</option>
          <option>Cabinda</option><option>Cuando Cubango</option><option>Cuanza Norte</option>
          <option>Cuanza Sul</option><option>Cunene</option><option>Huambo</option><option>Huíla</option>
          <option>Lunda Norte</option><option>Lunda Sul</option><option>Malanje</option>
          <option>Moxico</option><option>Namibe</option><option>Uíge</option><option>Zaire</option>
        </select>
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Município *</label>
        <input type="text" class="form-control" id="municipio" placeholder="Município">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Bairro *</label>
        <input type="text" class="form-control" id="bairro" placeholder="Bairro">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-12"><p class="sec-title">Filiação</p></div>
      <div class="col-md-6">
        <label class="form-label">Nome do Pai</label>
        <input type="text" class="form-control" id="nome_pai" placeholder="Nome do pai">
      </div>
      <div class="col-md-6">
        <label class="form-label">Nome da Mãe</label>
        <input type="text" class="form-control" id="nome_mae" placeholder="Nome da mãe">
      </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
      <button class="btn-prim" onclick="avancar(1)">Próximo <i class="fa fa-arrow-right ms-2"></i></button>
    </div>
  </div>

  <!-- PASSO 2 -->
  <div id="p2" class="card-form" style="display:none">
    <h5 style="font-family:'Oswald',sans-serif;color:#0d6efd;margin-bottom:1.5rem"><i class="fa fa-phone me-2"></i>CONTACTOS</h5>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Email *</label>
        <input type="email" class="form-control" id="email" placeholder="email@exemplo.com">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Telefone *</label>
        <input type="tel" class="form-control" id="telefone" placeholder="+244 9XX XXX XXX">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Telefone Alternativo</label>
        <input type="tel" class="form-control" id="telefone2" placeholder="+244 9XX XXX XXX">
      </div>
      <div class="col-md-6">
        <label class="form-label">Contacto de Emergência *</label>
        <input type="tel" class="form-control" id="contacto_emergencia" placeholder="Número de emergência">
        <div class="invalid-feedback">Campo obrigatório</div>
      </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
      <button class="btn-sec" onclick="recuar(2)"><i class="fa fa-arrow-left me-2"></i>Anterior</button>
      <button class="btn-prim" onclick="avancar(2)">Próximo <i class="fa fa-arrow-right ms-2"></i></button>
    </div>
  </div>

  <!-- PASSO 3 -->
  <div id="p3" class="card-form" style="display:none">
    <h5 style="font-family:'Oswald',sans-serif;color:#0d6efd;margin-bottom:1.5rem"><i class="fa fa-futbol me-2"></i>DADOS DESPORTIVOS</h5>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Posição Preferida</label>
        <select class="form-select" id="posicao">
          <option value="">Selecionar...</option>
          <option>Guarda-redes</option><option>Defesa Central</option><option>Defesa Esquerdo</option>
          <option>Defesa Direito</option><option>Médio Defensivo</option><option>Médio Central</option>
          <option>Médio Ofensivo</option><option>Extremo Esquerdo</option><option>Extremo Direito</option>
          <option>Ponta de Lança</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Clube Anterior</label>
        <input type="text" class="form-control" id="clube_anterior" placeholder="Nome do clube anterior">
      </div>
      <div class="col-12">
        <label class="form-label">Observações</label>
        <textarea class="form-control" id="observacoes" rows="3" placeholder="Lesões, informações médicas..."></textarea>
      </div>
      <div class="col-12">
        <div style="background:#f8f9fa;border:1px solid #dee2e6;border-radius:8px;padding:1rem">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="termos">
            <label class="form-check-label" style="font-size:.85rem" for="termos">
              Declaro que os dados são verdadeiros e aceito os <a href="#" style="color:#0d6efd">Termos e Condições</a>.
            </label>
          </div>
          <div class="invalid-feedback" id="e_termos" style="display:none">Deve aceitar os termos para continuar.</div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
      <button class="btn-sec" onclick="recuar(3)"><i class="fa fa-arrow-left me-2"></i>Anterior</button>
      <button class="btn-prim" onclick="avancar(3)">Próximo <i class="fa fa-arrow-right ms-2"></i></button>
    </div>
  </div>

  <!-- PASSO 4 -->
  <div id="p4" class="card-form" style="display:none">
    <h5 style="font-family:'Oswald',sans-serif;color:#0d6efd;margin-bottom:1.5rem"><i class="fa fa-credit-card me-2"></i>PAGAMENTO & SUBMISSÃO</h5>
    <div id="rupArea"><div class="text-center py-4"><i class="fa fa-spinner fa-spin fa-2x" style="color:#0d6efd"></i><p style="color:#6c757d;margin-top:.75rem">A gerar referência...</p></div></div>
    <div class="d-flex justify-content-between mt-4">
      <button class="btn-sec" onclick="recuar(4)"><i class="fa fa-arrow-left me-2"></i>Anterior</button>
      <button class="btn-prim" id="btnSub" onclick="submeter()"><i class="fa fa-paper-plane me-2"></i>SUBMETER</button>
    </div>
  </div>

  <!-- SUCESSO -->
  <div id="pSuc" class="card-form" style="display:none">
    <div class="text-center py-3">
      <div style="width:80px;height:80px;background:#d1fae5;border:2px solid #10b981;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;font-size:2rem;color:#10b981">
        <i class="fa fa-check"></i>
      </div>
      <h3 style="font-family:'Oswald',sans-serif;color:#0d6efd;letter-spacing:2px">CANDIDATURA SUBMETIDA!</h3>
      <p style="color:#6c757d">Receberás resposta em até 5 dias úteis.</p>
      <div id="resumo" style="background:#f1f5f9;border-radius:10px;padding:1.25rem;margin:1.25rem auto;max-width:400px;text-align:left;font-size:.875rem"></div>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <button class="btn-prim" onclick="gerarPDF()"><i class="fa fa-file-pdf me-2"></i>Baixar PDF</button>
        <a href="verificar.php" class="btn-sec" style="text-decoration:none">Verificar Estado</a>
        <a href="index.php" class="btn-sec" style="text-decoration:none">Início</a>
      </div>
    </div>
  </div>

</div></div></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="js/main.js"></script>
<script>
var RUP = null;
var FINAL = {};
var CATS = [
  {n:'Petizes',  a:5, b:7, v:3000},{n:'Traquinas',a:8, b:9, v:3000},
  {n:'Benjamins',a:10,b:11,v:3500},{n:'Infantis', a:12,b:13,v:4000},
  {n:'Iniciados',a:14,b:15,v:4500},{n:'Juvenis',  a:16,b:17,v:5000},
  {n:'Juniores', a:18,b:20,v:5500},{n:'Seniores', a:21,b:35,v:6000}
];

// ── Categoria ────────────────────────────────────────
function calcCat() {
  var dn = document.getElementById('data_nascimento').value;
  var box = document.getElementById('catBox');
  if (!dn) return;
  var h = new Date(), n = new Date(dn);
  var i = h.getFullYear()-n.getFullYear();
  if (h.getMonth()<n.getMonth()||(h.getMonth()===n.getMonth()&&h.getDate()<n.getDate())) i--;
  var c = null;
  for (var x=0;x<CATS.length;x++){if(i>=CATS[x].a&&i<=CATS[x].b){c=CATS[x];break;}}
  if (c) {
    box.innerHTML = '<i class="fa fa-layer-group me-2"></i>'+c.n+' <small style="opacity:.65;font-size:.75rem">'+c.a+'–'+c.b+' anos</small>';
    box.style.color='#0d6efd';
    document.getElementById('categoria').value = c.n;
    document.getElementById('valor_inscricao').value = c.v;
    limpar('data_nascimento'); limpar('categoria');
  } else {
    box.innerHTML = '<span style="color:#dc3545;font-size:.82rem"><i class="fa fa-times-circle me-1"></i>Fora do intervalo (5–35 anos)</span>';
    document.getElementById('categoria').value = '';
    document.getElementById('valor_inscricao').value = '';
  }
}
document.getElementById('data_nascimento').addEventListener('change', calcCat);

// ── Helpers ──────────────────────────────────────────
function g(id){ return document.getElementById(id); }
function v(id){ var e=g(id); return e?e.value.trim():''; }
function erro(id){ var e=g(id); if(e){e.classList.add('is-invalid');} }
function limpar(id){ var e=g(id); if(e){e.classList.remove('is-invalid');} }
function alerta(msg){ g('alertMsg').textContent=msg; g('alertBox').style.display='block'; window.scrollTo({top:g('alertBox').offsetTop-120,behavior:'smooth'}); }
function semAlerta(){ g('alertBox').style.display='none'; }
function setSN(ativo){
  for(var i=1;i<=4;i++){
    var s=g('sn'+i); s.className='sn';
    if(i<ativo) s.classList.add('done');
    if(i===ativo) s.classList.add('active');
  }
}

// ── Validação ────────────────────────────────────────
function validar(p) {
  semAlerta(); var ok=true;
  if (p===1) {
    ['nome_completo','bi','genero','provincia','municipio','bairro','data_nascimento'].forEach(function(id){
      if(!v(id)){erro(id);ok=false;}else{limpar(id);}
    });
    if (!v('categoria')) {
      g('e_cat').style.display='block'; ok=false;
    } else {
      g('e_cat').style.display='none';
    }
  }
  if (p===2) {
    ['email','telefone','contacto_emergencia'].forEach(function(id){
      if(!v(id)){erro(id);ok=false;}else{limpar(id);}
    });
  }
  if (p===3) {
    var t=g('termos');
    if(!t.checked){
      t.classList.add('is-invalid');
      g('e_termos').style.display='block';
      ok=false;
    } else {
      t.classList.remove('is-invalid');
      g('e_termos').style.display='none';
    }
  }
  if (!ok) alerta('Preencha todos os campos obrigatórios (assinalados a vermelho).');
  return ok;
}

// ── Navegação ────────────────────────────────────────
function avancar(de) {
  if (!validar(de)) return;
  g('p'+de).style.display='none';
  var para=de+1;
  g('p'+para).style.display='block';
  setSN(para);
  if (para===4) gerarRUP();
  semAlerta();
  window.scrollTo({top:0,behavior:'smooth'});
}
function recuar(de) {
  g('p'+de).style.display='none';
  var para=de-1;
  g('p'+para).style.display='block';
  setSN(para);
  semAlerta();
  window.scrollTo({top:0,behavior:'smooth'});
}

// ── Gerar RUP ────────────────────────────────────────
function gerarRUP() {
  fetch('api/gerar_rup.php')
    .then(function(r){return r.json();})
    .then(function(d){
      RUP=d.rup;
      var val=document.getElementById('valor_inscricao').value||'5000';
      g('rupArea').innerHTML=
        '<div class="rup-box">'+
          '<div style="font-size:.78rem;color:#6c757d;margin-bottom:.25rem">Referência Única de Pagamento</div>'+
          '<div class="rup-code">'+RUP+'</div>'+
        '</div>'+
        '<div style="background:#f8f9fa;border-radius:8px;padding:1rem;margin-bottom:1rem;font-size:.875rem">'+
          '<div><strong>Atleta:</strong> '+v('nome_completo')+'</div>'+
          '<div><strong>Categoria:</strong> '+v('categoria')+'</div>'+
          '<div><strong>Valor:</strong> '+Number(val).toLocaleString('pt-PT')+' AOA</div>'+
        '</div>'+
        '<div style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:.875rem;font-size:.82rem;color:#92400e;margin-bottom:1rem">'+
          '<i class="fa fa-exclamation-triangle me-1"></i>Efectue o pagamento usando o RUP como referência e submeta o comprovativo abaixo.'+
        '</div>'+
        '<div><label class="form-label">Comprovativo de Pagamento</label>'+
        '<input type="file" class="form-control" id="comprovativo" accept="image/*,.pdf"></div>';
    })
    .catch(function(){
      RUP='IC-'+new Date().getFullYear()+'-'+Math.floor(10000+Math.random()*90000);
      g('rupArea').innerHTML=g('rupArea').innerHTML; // trigger re-render
      setTimeout(gerarRUP,1000);
    });
}

// ── Submeter ─────────────────────────────────────────
function submeter() {
  if (!RUP){alerta('Aguarde a geração do RUP.');return;}
  var btn=g('btnSub');
  btn.disabled=true; btn.innerHTML='<i class="fa fa-spinner fa-spin me-2"></i>A submeter...';
  var fd=new FormData();
  [['rup',RUP],['nome_completo',v('nome_completo')],['data_nascimento',v('data_nascimento')],
   ['categoria',v('categoria')],['bi',v('bi')],['genero',v('genero')],['email',v('email')],
   ['telefone',v('telefone')],['telefone2',v('telefone2')],['provincia',v('provincia')],
   ['municipio',v('municipio')],['bairro',v('bairro')],['nome_pai',v('nome_pai')],
   ['nome_mae',v('nome_mae')],['contacto_emergencia',v('contacto_emergencia')],
   ['posicao_preferida',v('posicao')],['clube_anterior',v('clube_anterior')],
   ['observacoes',v('observacoes')],['valor_inscricao',document.getElementById('valor_inscricao').value]
  ].forEach(function(p){fd.append(p[0],p[1]);});
  var comp=g('comprovativo');
  if(comp&&comp.files[0]) fd.append('comprovativo',comp.files[0]);

  fetch('api/inscricao.php',{method:'POST',body:fd})
    .then(function(r){return r.json();})
    .then(function(d){
      if(d.success){
        FINAL={rup:RUP,nome:v('nome_completo'),bi:v('bi'),email:v('email'),
               categoria:v('categoria'),valor:document.getElementById('valor_inscricao').value,
               data:new Date().toLocaleDateString('pt-PT')};
        g('p4').style.display='none';
        g('sn4').className='sn done';
        g('resumo').innerHTML=
          '<div style="display:grid;gap:.35rem">'+
          '<div><strong>RUP:</strong> <span style="color:#0d6efd;font-family:Oswald,sans-serif">'+RUP+'</span></div>'+
          '<div><strong>Atleta:</strong> '+FINAL.nome+'</div>'+
          '<div><strong>Categoria:</strong> '+FINAL.categoria+'</div>'+
          '<div><strong>Valor:</strong> '+Number(FINAL.valor).toLocaleString('pt-PT')+' AOA</div>'+
          '</div>';
        g('pSuc').style.display='block';
        window.scrollTo({top:0,behavior:'smooth'});
      } else {
        alerta(d.message||'Erro ao submeter. Tente novamente.');
        btn.disabled=false; btn.innerHTML='<i class="fa fa-paper-plane me-2"></i>SUBMETER';
      }
    })
    .catch(function(){
      alerta('Erro de ligação. Verifique a sua conexão.');
      btn.disabled=false; btn.innerHTML='<i class="fa fa-paper-plane me-2"></i>SUBMETER';
    });
}

// ── PDF ──────────────────────────────────────────────
function gerarPDF(){
  var d=FINAL; if(!d.rup) return;
  var doc=new window.jspdf.jsPDF();
  var W=210,M=20;
  doc.setFillColor(11,94,215); doc.rect(0,0,W,35,'F');
  doc.setTextColor(255,255,255); doc.setFont('helvetica','bold'); doc.setFontSize(16);
  doc.text('ACADEMIA INTER CLUBE DE ANGOLA',W/2,14,{align:'center'});
  doc.setFont('helvetica','normal'); doc.setFontSize(10);
  doc.text('Comprovativo de Inscricao',W/2,22,{align:'center'});
  doc.text('Emitido em: '+d.data,W/2,29,{align:'center'});
  var y=48;
  doc.setFillColor(207,226,255); doc.roundedRect(M,y,W-2*M,20,3,3,'F');
  doc.setTextColor(13,110,253); doc.setFont('helvetica','bold'); doc.setFontSize(8);
  doc.text('REFERENCIA UNICA DE PAGAMENTO (RUP)',W/2,y+7,{align:'center'});
  doc.setFontSize(18); doc.text(d.rup,W/2,y+16,{align:'center'});
  y+=28;
  doc.setFillColor(11,94,215); doc.rect(M,y,W-2*M,8,'F');
  doc.setTextColor(255,255,255); doc.setFontSize(9); doc.setFont('helvetica','bold');
  doc.text('DADOS DA INSCRICAO',M+3,y+5.5); y+=11;
  [['Nome',d.nome],['BI',d.bi],['Email',d.email],['Categoria',d.categoria],
   ['Valor',Number(d.valor).toLocaleString('pt-PT')+' AOA']].forEach(function(r){
    doc.setTextColor(100,100,100); doc.setFont('helvetica','normal'); doc.setFontSize(8);
    doc.text(r[0]+':',M+3,y);
    doc.setTextColor(30,30,30); doc.setFont('helvetica','bold');
    doc.text(String(r[1]||'-'),M+50,y);
    doc.setDrawColor(220,220,220); doc.line(M,y+2,W-M,y+2); y+=8;
  });
  doc.setFillColor(11,94,215); doc.rect(0,275,W,22,'F');
  doc.setTextColor(255,255,255); doc.setFont('helvetica','normal'); doc.setFontSize(8);
  doc.text('Academia Inter Clube de Angola  |  interclubeac.ao',W/2,284,{align:'center'});
  doc.save('inscricao_'+d.rup.replace(/-/g,'_')+'.pdf');
}
</script>
</body>
</html>
