<?php
require_once '../includes/config.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) { echo json_encode(['success'=>false]); exit; }

$db = getDB();
$stmt = $db->prepare("INSERT INTO contactos (nome, email, telefone, assunto, mensagem) VALUES (?,?,?,?,?)");
$ok = $stmt->execute([
    sanitize($input['nome']),
    sanitize($input['email']),
    sanitize($input['telefone'] ?? ''),
    sanitize($input['assunto']),
    sanitize($input['mensagem'])
]);
echo json_encode(['success' => $ok]);
