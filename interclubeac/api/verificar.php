<?php
require_once '../includes/config.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$tipo  = $input['tipo']  ?? '';
$valor = trim($input['valor'] ?? '');

if (!$valor) { echo json_encode(['found'=>false]); exit; }

$db = getDB();
if ($tipo === 'email') {
    $stmt = $db->prepare("SELECT * FROM candidaturas WHERE email = ? LIMIT 1");
} else {
    $stmt = $db->prepare("SELECT * FROM candidaturas WHERE bi = ? LIMIT 1");
}
$stmt->execute([$valor]);
$c = $stmt->fetch();

if ($c) {
    echo json_encode([
        'found'     => true,
        'nome'      => $c['nome_completo'],
        'rup'       => $c['rup'],
        'categoria' => $c['categoria'],
        'status'    => $c['status'],
        'motivo'    => $c['motivo_rejeicao'],
        'email'     => $c['email'],
        'telefone'  => $c['telefone'],
        'provincia' => $c['provincia'],
        'data'      => $c['data_candidatura'],
        'valor'     => $c['valor_inscricao'],
        'bi'        => $c['bi'],
    ]);
} else {
    echo json_encode(['found'=>false]);
}
