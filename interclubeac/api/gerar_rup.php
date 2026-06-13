<?php
// api/gerar_rup.php
require_once '../includes/config.php';
header('Content-Type: application/json');
echo json_encode(['rup' => generateRUP()]);
