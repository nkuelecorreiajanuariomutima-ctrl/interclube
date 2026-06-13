<?php
// api/inscricao.php
require_once '../includes/config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$db = getDB();

// Campos obrigatórios
$required = ['rup','nome_completo','data_nascimento','categoria','bi','email','telefone','provincia','municipio','bairro','contacto_emergencia','valor_inscricao'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => "Campo obrigatório em falta: $field"]);
        exit;
    }
}

// Verificar duplicados
$check = $db->prepare("SELECT id FROM candidaturas WHERE bi = ? OR email = ?");
$check->execute([sanitize($_POST['bi']), sanitize($_POST['email'])]);
if ($check->rowCount() > 0) {
    echo json_encode(['success' => false, 'message' => 'Já existe uma candidatura com este BI ou email.']);
    exit;
}

// Upload foto
$fotoPath = null;
if (!empty($_FILES['foto_atleta']['name'])) {
    $fotoPath = uploadFile($_FILES['foto_atleta'], 'fotos');
}

// Upload comprovativo
$comprovPath = null;
if (!empty($_FILES['comprovativo']['name'])) {
    $comprovPath = uploadFile($_FILES['comprovativo'], 'comprovativos');
}

$status = $comprovPath ? 'em_analise' : 'pagamento_pendente';

// Inserir
$stmt = $db->prepare("
    INSERT INTO candidaturas 
    (rup, nome_completo, data_nascimento, categoria, bi, email, telefone, telefone2,
     provincia, municipio, bairro, nome_pai, nome_mae, contacto_emergencia,
     posicao_preferida, clube_anterior, observacoes, foto_atleta, 
     comprovativo_pagamento, valor_inscricao, status)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
");

$ok = $stmt->execute([
    sanitize($_POST['rup']),
    sanitize($_POST['nome_completo']),
    sanitize($_POST['data_nascimento']),
    sanitize($_POST['categoria']),
    sanitize($_POST['bi']),
    sanitize($_POST['email']),
    sanitize($_POST['telefone']),
    sanitize($_POST['telefone2'] ?? ''),
    sanitize($_POST['provincia']),
    sanitize($_POST['municipio']),
    sanitize($_POST['bairro']),
    sanitize($_POST['nome_pai'] ?? ''),
    sanitize($_POST['nome_mae'] ?? ''),
    sanitize($_POST['contacto_emergencia']),
    sanitize($_POST['posicao_preferida'] ?? ''),
    sanitize($_POST['clube_anterior'] ?? ''),
    sanitize($_POST['observacoes'] ?? ''),
    $fotoPath,
    $comprovPath,
    floatval($_POST['valor_inscricao']),
    $status
]);

if ($ok) {
    echo json_encode(['success' => true, 'rup' => $_POST['rup'], 'message' => 'Candidatura registada com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao guardar a candidatura.']);
}
