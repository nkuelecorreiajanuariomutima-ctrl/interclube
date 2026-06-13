# 🔴⚫ Academia Inter Clube - Sistema de Inscrição
## Guia de Instalação e Configuração

### Tecnologias Utilizadas
- **Frontend:** HTML5, Bootstrap 5.3, CSS3, JavaScript (Vanilla)
- **Backend:** PHP 8.x (puro)
- **Base de Dados:** MySQL 8.x
- **Fontes:** Google Fonts (Oswald + Barlow)
- **Ícones:** Font Awesome 6

---

## 📁 Estrutura de Ficheiros

```
interclubeac/
├── index.php              ← Página inicial
├── inscricao.php          ← Formulário de inscrição (4 passos)
├── verificar.php          ← Verificar candidatura
├── eventos.php            ← Eventos públicos
├── sobre.php              ← Sobre a academia
├── contactos.php          ← Página de contactos
├── database.sql           ← Script da base de dados
├── includes/
│   └── config.php         ← Configurações + funções globais
├── css/
│   └── style.css          ← Estilos principais (cores IC)
├── js/
│   └── main.js            ← JavaScript principal
├── api/
│   ├── inscricao.php      ← API: submeter candidatura
│   ├── verificar.php      ← API: verificar candidatura
│   ├── categoria.php      ← API: obter categoria por idade
│   ├── gerar_rup.php      ← API: gerar RUP único
│   └── contacto.php       ← API: enviar mensagem
├── admin/
│   ├── login.php          ← Login admin
│   ├── dashboard.php      ← Painel principal
│   ├── candidaturas.php   ← Gestão de candidaturas
│   ├── candidatura_detalhe.php ← Detalhes + aprovar/rejeitar
│   ├── eventos.php        ← Gestão de eventos
│   ├── contactos.php      ← Mensagens recebidas
│   ├── api_admin.php      ← API: ações admin
│   └── logout.php
└── uploads/               ← Ficheiros enviados
    ├── fotos/             ← Fotos dos atletas
    └── comprovativos/     ← Comprovativos de pagamento
```

---

## ⚙️ Instalação

### 1. Requisitos do Servidor
- PHP 8.0+
- MySQL 8.0+
- Apache/Nginx com mod_rewrite

### 2. Configurar Base de Dados
```sql
-- Execute o ficheiro database.sql no MySQL:
mysql -u root -p < database.sql
```

### 3. Configurar Ligação
Edite `includes/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_password');
define('DB_NAME', 'interclubeac');
define('SITE_URL', 'http://seu-dominio.ao/interclubeac');
```

### 4. Permissões de Upload
```bash
chmod 755 uploads/
chmod 755 uploads/fotos/
chmod 755 uploads/comprovativos/
```

### 5. Acesso Admin
```
URL:   http://seu-dominio/interclubeac/admin/login.php
Email: admin@interclubeac.ao
Pass:  Admin@2024
```
⚠️ **ALTERE A PASSWORD NO PRIMEIRO ACESSO!**

---

## 🎮 Funcionalidades

### Site Público
| Página | Descrição |
|--------|-----------|
| Início | Hero, stats, categorias, eventos, verificação rápida |
| Inscrição | Formulário 4 passos com geração automática de RUP |
| Verificar | Consulta por email ou número de BI |
| Eventos | Lista de eventos publicados |
| Sobre | História e missão da academia |
| Contactos | Formulário + informações de contacto |

### Painel Admin
| Módulo | Funcionalidades |
|--------|----------------|
| Dashboard | KPIs, últimas candidaturas, resumo de estados |
| Candidaturas | Listar, filtrar, pesquisar, ver detalhes |
| Detalhe | Aprovar, rejeitar (com motivo), notas internas, ver comprovativo |
| Eventos | Criar, editar, publicar/despublicar, eliminar, destacar |
| Contactos | Ver mensagens, responder por email, marcar como lido |

### Fluxo do Atleta
```
1. Preenche formulário (4 passos)
   └─ Dados pessoais → Contactos → Dados desportivos → Pagamento

2. Sistema gera RUP automaticamente (ex: IC-2025-00123)

3. Atleta efectua pagamento e submete comprovativo

4. Admin analisa e aprova/rejeita

5. Atleta pode verificar estado a qualquer momento
```

### Categorias por Idade (Automáticas)
| Categoria | Idades | Valor |
|-----------|--------|-------|
| Petizes | 5-7 anos | 3.000 AOA |
| Traquinas | 8-9 anos | 3.000 AOA |
| Benjamins | 10-11 anos | 3.500 AOA |
| Infantis | 12-13 anos | 4.000 AOA |
| Iniciados | 14-15 anos | 4.500 AOA |
| Juvenis | 16-17 anos | 5.000 AOA |
| Juniores | 18-20 anos | 5.500 AOA |
| Seniores | 21+ anos | 6.000 AOA |

---

## 🎨 Identidade Visual
- **Cor Principal:** Vermelho `#CC0000`
- **Cor Secundária:** Preto `#0D0D0D`
- **Cor de Destaque:** Ouro `#FFD700`
- **Fontes:** Oswald (títulos) + Barlow (corpo)

---

## 🔐 Segurança
- PDO com prepared statements (proteção SQL injection)
- Sanitização de todos os inputs
- Verificação de sessão no admin
- Validação de tipos de ficheiro no upload
- Limite de 5MB por upload

---

*Desenvolvido para a Academia Inter Clube de Angola 🇦🇴*
