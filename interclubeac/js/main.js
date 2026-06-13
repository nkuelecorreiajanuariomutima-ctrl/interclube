// ============================================
// INTER CLUBE ACADEMIA - JavaScript Principal
// ============================================

document.addEventListener('DOMContentLoaded', function() {

    // Navbar scroll effect
    const nav = document.getElementById('mainNav');
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });
    }


    // Verify tabs (homepage)
    const tabs = document.querySelectorAll('.verify-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById('tab-email').style.display = 'none';
            document.getElementById('tab-bi').style.display = 'none';
            document.getElementById('tab-' + tab.dataset.tab).style.display = 'block';
        });
    });

    // Number animations
    const numEls = document.querySelectorAll('.stat-num, .kpi-num');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumber(entry.target);
                observer.unobserve(entry.target);
            
            }
        });
    });
    numEls.forEach(el => observer.observe(el));
});

function animateNumber(el) {
    const target = parseInt(el.textContent.replace(/\D/g, ''));
    if (!target) return;
    let current = 0;
    const step = target / 50;
    const suffix = el.textContent.replace(/[\d]/g, '').trim();
    const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = Math.floor(current) + suffix;
        if (current >= target) clearInterval(timer);
    }, 30);
}

// Verificar candidatura (homepage quick check)
async function verificarCandidatura(tipo) {
    const val = tipo === 'email' 
        ? document.getElementById('checkEmail')?.value 
        : document.getElementById('checkBI')?.value;
    
    if (!val || !val.trim()) {
        showVerifyResult('Insira um valor para verificar.', 'warning');
        return;
    }

    const btn = event.target;
    btn.innerHTML = '<span class="spinner-ic"></span> A verificar...';
    btn.disabled = true;

    try {
        const res = await fetch('api/verificar.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({tipo, valor: val.trim()})
        });
        const data = await res.json();
        
        if (data.found) {
            const statusMap = {
                'pendente': {label: 'Pendente', cls: 'warning'},
                'pagamento_pendente': {label: 'Aguarda Pagamento', cls: 'info'},
                'em_analise': {label: 'Em Análise', cls: 'info'},
                'aprovado': {label: 'Aprovado ✓', cls: 'success'},
                'rejeitado': {label: 'Rejeitado', cls: 'danger'},
            };
            const st = statusMap[data.status] || {label: data.status, cls: 'secondary'};
            showVerifyResult(`
                <div class="d-flex align-items-center gap-2 mb-2">
                    <strong class="text-white">${escHtml(data.nome)}</strong>
                    <span class="badge bg-${st.cls}">${st.label}</span>
                </div>
                <div class="text-muted small">RUP: <span class="text-gold">${escHtml(data.rup)}</span> &bull; Categoria: ${escHtml(data.categoria)}</div>
                ${data.status === 'aprovado' ? '<div class="mt-2 text-success small"><i class="fa fa-check-circle me-1"></i>A tua inscrição foi aprovada!</div>' : ''}
                ${data.status === 'rejeitado' ? `<div class="mt-2 text-danger small"><i class="fa fa-times-circle me-1"></i>${data.motivo || 'Inscrição não aprovada.'}</div>` : ''}
            `, 'found');
        } else {
            showVerifyResult('Nenhuma candidatura encontrada com esses dados.', 'not-found');
        }
    } catch(e) {
        showVerifyResult('Erro ao verificar. Tenta novamente.', 'error');
    }

    btn.innerHTML = '<i class="fa fa-search me-2"></i>Verificar Estado';
    btn.disabled = false;
}

function showVerifyResult(html, type) {
    const el = document.getElementById('verifyResult');
    if (!el) return;
    const cls = {
        found: 'alert-ic alert-ic-success',
        'not-found': 'alert-ic alert-ic-warning',
        warning: 'alert-ic alert-ic-warning',
        error: 'alert-ic alert-ic-error',
        info: 'alert-ic alert-ic-info'
    }[type] || 'alert-ic alert-ic-info';
    el.innerHTML = `<div class="p-3 ${cls} rounded">${html}</div>`;
}

function escHtml(s) {
    const d = document.createElement('div');
    d.appendChild(document.createTextNode(s || ''));
    return d.innerHTML;
}

// Toast notifications
function showToast(msg, type = 'success') {
    const div = document.createElement('div');
    div.className = `toast-ic toast-${type}`;
    div.innerHTML = `<i class="fa fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${msg}`;
    document.body.appendChild(div);
    setTimeout(() => div.classList.add('show'), 10);
    setTimeout(() => { div.classList.remove('show'); setTimeout(() => div.remove(), 300); }, 3500);
}

// Upload preview
function setupUploadPreview(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    if (!input || !preview) return;
    
    input.addEventListener('change', () => {
        const file = input.files[0];
        if (!file) return;
        preview.textContent = `✓ ${file.name} (${(file.size/1024).toFixed(0)}KB)`;
        preview.style.color = '#2ecc71';
    });
}

// Print RUP
function printRUP() {
    window.print();
}

// Copy RUP
function copyRUP(rup) {
    navigator.clipboard.writeText(rup).then(() => showToast('RUP copiado!'));
}
