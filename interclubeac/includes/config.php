<?php
// ============================================
// CONFIGURAÇÃO DA BASE DE DADOS
// Inter Clube Academia - Angola
// ============================================

// Iniciar sessão uma única vez
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// conexao com banco de dados 

define('DB_HOST', 'sql305.infinityfree.com');
define('DB_USER', 'if0_41873782');
define('DB_PASS', 'SUA_SENHA_DO_MYSQL');
define('DB_NAME', 'if0_41873782_interclubeac');
define('SITE_URL', 'https://interclube.kesug.com');

// Configurações do Site
define('SITE_NAME', 'Academia Inter Clube');
define('SITE_URL', 'http://localhost/interclubeac');
define('SITE_EMAIL', 'geral@interclubeac.ao');
define('SITE_TEL', '+244 923 456 789');

// Caminhos de Upload
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');

// Conexão PDO
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die(json_encode(['error' => 'Erro de conexão: ' . $e->getMessage()]));
        }
    }
    return $pdo;
}

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function generateRUP() {
    $db = getDB();
    do {
        $year = date('Y');
        $rand = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $rup = 'IC-' . $year . '-' . $rand;
        $stmt = $db->prepare("SELECT id FROM candidaturas WHERE rup = ?");
        $stmt->execute([$rup]);
    } while ($stmt->rowCount() > 0);
    return $rup;
}

function getCategoriaByIdade($dataNascimento) {
    $idade = date_diff(date_create($dataNascimento), date_create('today'))->y;

    // Tentar primeiro na base de dados
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM categorias WHERE ? BETWEEN idade_min AND idade_max AND ativo = 1 LIMIT 1");
        $stmt->execute([$idade]);
        $cat = $stmt->fetch();
        if ($cat) return $cat;
    } catch (Exception $e) {}

    // Fallback: categorias fixas caso a tabela esteja vazia
    $categorias = [
        ['nome'=>'Petizes',   'idade_min'=>5,  'idade_max'=>7,  'valor_inscricao'=>3000],
        ['nome'=>'Traquinas', 'idade_min'=>8,  'idade_max'=>9,  'valor_inscricao'=>3000],
        ['nome'=>'Benjamins', 'idade_min'=>10, 'idade_max'=>11, 'valor_inscricao'=>3500],
        ['nome'=>'Infantis',  'idade_min'=>12, 'idade_max'=>13, 'valor_inscricao'=>4000],
        ['nome'=>'Iniciados', 'idade_min'=>14, 'idade_max'=>15, 'valor_inscricao'=>4500],
        ['nome'=>'Juvenis',   'idade_min'=>16, 'idade_max'=>17, 'valor_inscricao'=>5000],
        ['nome'=>'Juniores',  'idade_min'=>18, 'idade_max'=>20, 'valor_inscricao'=>5500],
        ['nome'=>'Seniores',  'idade_min'=>21, 'idade_max'=>35, 'valor_inscricao'=>6000],
    ];
    foreach ($categorias as $cat) {
        if ($idade >= $cat['idade_min'] && $idade <= $cat['idade_max']) {
            return $cat;
        }
    }
    return null;
}

function uploadFile($file, $folder = '') {
    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return false;
    if ($file['size'] > 5 * 1024 * 1024) return false;

    $dir = UPLOAD_PATH . $folder;
    if (!is_dir($dir)) mkdir($dir, 0755, true);

    $filename = uniqid() . '_' . time() . '.' . $ext;
    $dest = $dir . '/' . $filename;
    if (move_uploaded_file($file['tmp_name'], $dest)) {
        return $folder ? $folder . '/' . $filename : $filename;
    }
    return false;
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}
?>
