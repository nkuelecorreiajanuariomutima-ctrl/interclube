<?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verificar Candidatura - Academia Inter Clube</title>
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
                <li class="nav-item"><a class="nav-link" href="contactos.php"><i class="fa fa-phone me-1"></i>Contactos</a></li>
                <li class="nav-item"><a class="nav-link active" href="verificar.php"><i class="fa fa-search me-1"></i>Verificar</a></li>
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
    <h1><i class="fa fa-search me-3"></i>VERIFICAR CANDIDATURA</h1>
    <p style="color:rgba(255,255,255,0.7)">Consulte o estado da sua inscrição na Academia Inter Clube</p>
  </div>
</div>

<section style="background:var(--gray-100);padding:3rem 0;min-height:60vh">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-7">

      <!-- Formulário de pesquisa -->
      <div id="searchBlock">
        <div class="form-card mb-4">
          <div class="form-card-header">
            <i class="fa fa-search"></i><h4>CONSULTAR ESTADO</h4>
          </div>
          <div class="form-card-body">
            <div class="verify-tabs d-flex mb-4" id="verifyTabs">
              <button class="verify-tab active" data-tab="email" onclick="switchTab(this)"><i class="fa fa-envelope me-2"></i>Por Email</button>
              <button class="verify-tab" data-tab="bi" onclick="switchTab(this)"><i class="fa fa-id-card me-2"></i>Por Nº BI</button>
            </div>
            <div id="tab-email">
              <label class="form-label">Endereço de Email</label>
              <input type="email" class="form-control ic-input mb-3" id="checkEmail" placeholder="O email usado na inscrição">
              <button class="btn btn-ic-primary w-100" onclick="verificar('email')">
                <i class="fa fa-search me-2"></i>Consultar Estado
              </button>
            </div>
            <div id="tab-bi" style="display:none">
              <label class="form-label">Número do Bilhete de Identidade</label>
              <input type="text" class="form-control ic-input mb-3" id="checkBI" placeholder="Ex: 005123456LA041">
              <button class="btn btn-ic-primary w-100" onclick="verificar('bi')">
                <i class="fa fa-search me-2"></i>Consultar Estado
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Resultado -->
      <div id="verifyResult"></div>

    </div>

    <div class="col-lg-4">
      <div class="form-card">
        <div class="form-card-header"><i class="fa fa-info-circle"></i><h4>ESTADOS</h4></div>
        <div class="form-card-body">
          <div class="d-flex flex-column gap-3">
            <div class="d-flex gap-2 align-items-start">
              <span class="status-badge badge-pendente" style="white-space:nowrap">Pendente</span>
              <p style="font-size:0.82rem;color:var(--gray-600);margin:0">Candidatura recebida, aguarda processamento.</p>
            </div>
            <div class="d-flex gap-2 align-items-start">
              <span class="status-badge badge-pagamento_pendente" style="white-space:nowrap">Pag. Pendente</span>
              <p style="font-size:0.82rem;color:var(--gray-600);margin:0">RUP gerado. Aguarda comprovativo.</p>
            </div>
            <div class="d-flex gap-2 align-items-start">
              <span class="status-badge badge-em_analise" style="white-space:nowrap">Em Análise</span>
              <p style="font-size:0.82rem;color:var(--gray-600);margin:0">Comprovativo recebido. Em análise técnica.</p>
            </div>
            <div class="d-flex gap-2 align-items-start">
              <span class="status-badge badge-aprovado" style="white-space:nowrap">Aprovado</span>
              <p style="font-size:0.82rem;color:var(--gray-600);margin:0">Inscrição aprovada! Aguarda contacto.</p>
            </div>
            <div class="d-flex gap-2 align-items-start">
              <span class="status-badge badge-rejeitado" style="white-space:nowrap">Rejeitado</span>
              <p style="font-size:0.82rem;color:var(--gray-600);margin:0">Não aprovada. Ver motivo nos detalhes.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<footer class="footer py-4">
  <div class="container text-center">
    <p style="color:rgba(255,255,255,0.5);font-size:0.85rem;margin:0">&copy; <?= date('Y') ?> Academia Inter Clube &bull; Luanda, Angola</p>
  </div>
</footer>

<!-- PDF hidden print area -->
<div id="pdfArea" style="display:none"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="js/main.js"></script>
<script>
let lastData = null;

function switchTab(btn) {
  const tab = btn.getAttribute('data-tab');
  document.querySelectorAll('.verify-tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('tab-email').style.display = (tab === 'email') ? 'block' : 'none';
  document.getElementById('tab-bi').style.display   = (tab === 'bi')    ? 'block' : 'none';
}

function escHtml(s) {
  if (!s) return '—';
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

// Para uso no jsPDF - converte caracteres especiais para ASCII
function pdfTxt(s) {
  if (!s) return '-';
  var str = String(s);
  var accents = {'a':['á','à','â','ã','ä'],'e':['é','è','ê','ë'],'i':['í','ì','î','ï'],
                 'o':['ó','ò','ô','õ','ö'],'u':['ú','ù','û','ü'],'c':['ç'],'n':['ñ'],
                 'A':['Á','À','Â','Ã'],'E':['É','È','Ê'],'I':['Í','Î'],
                 'O':['Ó','Ô','Õ'],'U':['Ú','Û'],'C':['Ç'],'N':['Ñ']};
  for (var base in accents) {
    for (var i = 0; i < accents[base].length; i++) {
      str = str.split(accents[base][i]).join(base);
    }
  }
  return str;
}

async function verificar(tipo) {
  const val = tipo === 'email'
    ? document.getElementById('checkEmail').value.trim()
    : document.getElementById('checkBI').value.trim();

  if (!val) {
    document.getElementById('verifyResult').innerHTML =
      '<div class="alert-ic alert-ic-warning p-3 rounded"><i class="fa fa-exclamation-triangle me-2"></i>Por favor insira um valor para verificar.</div>';
    return;
  }

  document.getElementById('verifyResult').innerHTML =
    '<div class="text-center py-4"><div class="spinner-ic" style="width:32px;height:32px;border-width:3px;margin:0 auto"></div><p style="color:var(--gray-600);margin-top:1rem;font-size:0.9rem">A verificar...</p></div>';

  try {
    const res = await fetch('api/verificar.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({tipo, valor: val})
    });
    const data = await res.json();

    if (data.found) {
      lastData = data;
      renderResultado(data);
    } else {
      document.getElementById('verifyResult').innerHTML =
        `<div class="alert-ic alert-ic-warning p-3 rounded">
          <i class="fa fa-search me-2"></i>Nenhuma candidatura encontrada com esses dados.
          <a href="inscricao.php" style="color:var(--blue);font-weight:600;margin-left:0.5rem">Fazer inscrição →</a>
        </div>`;
    }
  } catch(e) {
    document.getElementById('verifyResult').innerHTML =
      '<div class="alert-ic alert-ic-error p-3 rounded"><i class="fa fa-exclamation-circle me-2"></i>Erro de ligação. Por favor tente novamente.</div>';
  }
}

const STATUS_INFO = {
  'pendente':           {label:'PENDENTE',          cls:'badge-pendente',           icon:'clock',        color:'#D97706', msg:'A sua candidatura foi recebida e está a aguardar processamento inicial.'},
  'pagamento_pendente': {label:'AGUARDA PAGAMENTO',  cls:'badge-pagamento_pendente', icon:'credit-card',  color:'#7C3AED', msg:'Por favor efectue o pagamento usando o RUP abaixo e submeta o comprovativo.'},
  'em_analise':         {label:'EM ANALISE',         cls:'badge-em_analise',         icon:'hourglass-half',color:'#0d6efd',msg:'O comprovativo foi recebido e a equipa técnica está a analisar a sua candidatura.'},
  'aprovado':           {label:'APROVADO',         cls:'badge-aprovado',           icon:'check-circle', color:'#16A34A', msg:'Parabéns! A sua inscrição foi aprovada. Receberá informações por contacto em breve.'},
  'rejeitado':          {label:'REJEITADO',          cls:'badge-rejeitado',          icon:'times-circle', color:'#DC2626', msg:'A sua candidatura não foi aprovada.'},
};

function renderResultado(d) {
  const st  = STATUS_INFO[d.status] || {label:d.status, cls:'', icon:'info-circle', color:'#333', msg:''};
  const ini = (d.nome||'').split(' ').map(n=>n[0]).slice(0,2).join('').toUpperCase();
  const dt  = d.data ? new Date(d.data).toLocaleDateString('pt-PT',{day:'2-digit',month:'long',year:'numeric'}) : '—';

  const alertType = d.status==='aprovado' ? 'alert-ic-success' : d.status==='rejeitado' ? 'alert-ic-error' : 'alert-ic-info';

  document.getElementById('verifyResult').innerHTML = `
  <div class="resultado-card" id="resultCard">

    <!-- Header atleta -->
    <div style="display:flex;align-items:center;gap:1.25rem;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border)">
      <div style="width:60px;height:60px;background:linear-gradient(135deg,var(--blue-dark),var(--blue));border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.4rem;color:#fff;flex-shrink:0">${ini}</div>
      <div class="flex-grow-1">
        <h5 style="font-family:var(--font-display);color:var(--blue);margin:0 0 0.35rem;font-size:1.2rem">${escHtml(d.nome)}</h5>
        <div style="display:flex;flex-wrap:wrap;gap:0.5rem;align-items:center">
          <span class="status-badge ${st.cls}"><i class="fa fa-${st.icon} me-1"></i>${st.label}</span>
          <span style="font-size:0.8rem;color:var(--gray-600)">Categoria: <strong style="color:var(--blue)">${escHtml(d.categoria)}</strong></span>
        </div>
      </div>
    </div>

    <!-- Dados principais -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:1rem">
      <div style="background:var(--blue-pale);border-radius:8px;padding:0.875rem">
        <div style="font-size:0.72rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.25rem">Referência (RUP)</div>
        <div style="font-family:var(--font-display);color:var(--blue);font-size:1.1rem;letter-spacing:2px">${escHtml(d.rup)}</div>
      </div>
      <div style="background:var(--blue-pale);border-radius:8px;padding:0.875rem">
        <div style="font-size:0.72rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.25rem">Data de Candidatura</div>
        <div style="color:var(--text);font-size:0.9rem;font-weight:600">${dt}</div>
      </div>
      <div style="background:var(--blue-pale);border-radius:8px;padding:0.875rem">
        <div style="font-size:0.72rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.25rem">Email</div>
        <div style="color:var(--text);font-size:0.85rem">${escHtml(d.email||'—')}</div>
      </div>
      <div style="background:var(--blue-pale);border-radius:8px;padding:0.875rem">
        <div style="font-size:0.72rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.25rem">Valor de Inscrição</div>
        <div style="color:var(--blue);font-family:var(--font-display);font-size:1rem">${d.valor ? Number(d.valor).toLocaleString('pt-PT') + ' AOA' : '—'}</div>
      </div>
    </div>

    <!-- Mensagem de estado -->
    <div class="alert-ic ${alertType} p-3 rounded mb-3">
      <i class="fa fa-${st.icon} me-2"></i>${st.msg}
      ${d.status==='rejeitado' && d.motivo ? '<br><strong>Motivo:</strong> '+escHtml(d.motivo) : ''}
    </div>

    <!-- Botões de acção -->
    <div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-top:1rem">
      <button class="btn btn-ic-primary" onclick="gerarPDFVerificacao()">
        <i class="fa fa-file-pdf me-2"></i>Baixar Comprovativo PDF
      </button>
      ${d.status==='pagamento_pendente' ? '<a href="inscricao.php" class="btn btn-outline-blue"><i class="fa fa-upload me-2"></i>Submeter Comprovativo</a>' : ''}
      <button class="btn" style="border:1px solid var(--gray-200);color:var(--gray-600)" onclick="voltarPesquisa()">
        <i class="fa fa-arrow-left me-2"></i>Nova Pesquisa
      </button>
    </div>

  </div>`;
}

function voltarPesquisa() {
  document.getElementById('verifyResult').innerHTML = '';
  document.getElementById('checkEmail').value = '';
  document.getElementById('checkBI').value = '';
  lastData = null;
  window.scrollTo({top: document.getElementById('searchBlock').offsetTop - 100, behavior:'smooth'});
}

function gerarPDFVerificacao() {
  if (!lastData) return;
  const d  = lastData;
  const st = STATUS_INFO[d.status] || {label:d.status, color:'#333'};
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({orientation:'portrait', unit:'mm', format:'a4'});
  const W = 210, M = 20;

  // Header azul
  doc.setFillColor(0, 71, 171);
  doc.rect(0, 0, W, 38, 'F');
  doc.setFillColor(204, 0, 0);
  doc.rect(0, 38, W, 2, 'F');

  doc.setTextColor(255,255,255);
  doc.setFontSize(18); doc.setFont('helvetica','bold');
  doc.text('ACADEMIA INTER CLUBE DE ANGOLA', W/2, 14, {align:'center'});
  doc.setFontSize(10); doc.setFont('helvetica','normal');
  doc.text('Comprovativo de Consulta de Candidatura', W/2, 22, {align:'center'});
  doc.setFontSize(8);
  doc.text('Gerado em: ' + new Date().toLocaleString('pt-PT'), W/2, 30, {align:'center'});

  let y = 50;

  // RUP destaque
  doc.setFillColor(238, 244, 255);
  doc.roundedRect(M, y, W-2*M, 20, 3, 3, 'F');
  doc.setTextColor(0, 71, 171); doc.setFontSize(8); doc.setFont('helvetica','normal');
  doc.text('REFERÊNCIA ÚNICA DE PAGAMENTO (RUP)', W/2, y+6, {align:'center'});
  doc.setFontSize(18); doc.setFont('helvetica','bold');
  doc.text(d.rup || '—', W/2, y+15, {align:'center'});
  y += 28;

  // Estado
  doc.setFillColor(248,250,252);
  doc.roundedRect(M, y, W-2*M, 14, 3, 3, 'F');
  doc.setFontSize(9); doc.setFont('helvetica','bold');
  doc.setTextColor(80,80,80); doc.text('ESTADO DA CANDIDATURA:', M+5, y+6);
  const stColor = d.status==='aprovado' ? [22,163,74] : d.status==='rejeitado' ? [220,38,38] : [0,71,171];
  doc.setTextColor(...stColor);
  // Usar texto simples sem caracteres especiais para jsPDF
  const statusTexto = {
    'aprovado': 'APROVADO',
    'rejeitado': 'REJEITADO',
    'em_analise': 'EM ANALISE',
    'pendente': 'PENDENTE',
    'pagamento_pendente': 'AGUARDA PAGAMENTO'
  }[d.status] || d.status.toUpperCase();
  doc.text(statusTexto, M+70, y+6);
  y += 22;

  // Secção dados pessoais
  function sectionTitle(title, yy) {
    doc.setFillColor(0,48,128); doc.rect(M, yy, W-2*M, 7, 'F');
    doc.setTextColor(255,255,255); doc.setFontSize(8); doc.setFont('helvetica','bold');
    doc.text(title, M+3, yy+5);
    return yy + 10;
  }
  function row(label, value, yy) {
    doc.setTextColor(100,100,100); doc.setFontSize(8); doc.setFont('helvetica','normal');
    doc.text(label + ':', M+3, yy);
    doc.setTextColor(30,41,59); doc.setFont('helvetica','bold');
    doc.text(String(value||'—'), M+60, yy);
    doc.setDrawColor(230,230,230); doc.line(M, yy+2, W-M, yy+2);
    return yy + 7;
  }

  y = sectionTitle('DADOS DO ATLETA', y);
  y = row('Nome Completo',   d.nome,       y);
  y = row('Email',           d.email,      y);
  y = row('Categoria',       d.categoria,  y);
  y = row('Data Candidatura', new Date(d.data).toLocaleDateString('pt-PT'), y);
  y = row('Valor Inscrição',  d.valor ? Number(d.valor).toLocaleString('pt-PT') + ' AOA' : '—', y);
  y += 5;

  // Mensagem de estado
  if (d.status === 'rejeitado' && d.motivo) {
    doc.setFillColor(255,235,235);
    doc.roundedRect(M, y, W-2*M, 16, 2, 2, 'F');
    doc.setTextColor(220,38,38); doc.setFontSize(8); doc.setFont('helvetica','bold');
    doc.text('MOTIVO DA REJEIÇÃO:', M+4, y+6);
    doc.setFont('helvetica','normal'); doc.setTextColor(60,60,60);
    const lines = doc.splitTextToSize(d.motivo, W-2*M-8);
    doc.text(lines, M+4, y+12);
    y += 22;
  }

  // Próximos passos
  y += 4;
  y = sectionTitle('PRÓXIMOS PASSOS', y);
  const passos = {
    'pendente':           'Aguarde contacto da Academia. O processo de avaliação está em curso.',
    'pagamento_pendente': 'Efectue o depósito/transferência usando o RUP como referência e submeta o comprovativo no site.',
    'em_analise':         'O seu comprovativo foi recebido. A equipa técnica está a analisar. Aguarde resultado.',
    'aprovado':           'Parabéns! Aguarde contacto da Academia com informações sobre o início das actividades.',
    'rejeitado':          'Pode contactar a Academia para esclarecimentos adicionais sobre a decisão.',
  };
  doc.setTextColor(60,60,60); doc.setFontSize(8.5); doc.setFont('helvetica','normal');
  const passLines = doc.splitTextToSize(passos[d.status] || '', W-2*M-6);
  doc.text(passLines, M+3, y);
  y += passLines.length * 5 + 8;

  // Footer
  doc.setFillColor(0,48,128);
  doc.rect(0, 280, W, 17, 'F');
  doc.setTextColor(255,255,255); doc.setFontSize(7.5);
  doc.text('Academia Inter Clube de Angola  |  interclubeac.ao  |  geral@interclubeac.ao', W/2, 287, {align:'center'});
  doc.setTextColor(255,215,0);
  doc.text('Este documento é válido como comprovativo de consulta.', W/2, 293, {align:'center'});

  doc.save('candidatura_' + (d.rup||'IC').replace(/-/g,'_') + '.pdf');
}
</script>
</body>
</html>
