<?php
// api/categoria.php
require_once '../includes/config.php';
header('Content-Type: application/json');

$data = $_GET['data'] ?? '';
if (!$data) { echo json_encode(['categoria' => null]); exit; }

$cat = getCategoriaByIdade($data);
echo json_encode(['categoria' => $cat]);
