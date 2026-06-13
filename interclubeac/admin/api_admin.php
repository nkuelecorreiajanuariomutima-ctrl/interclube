<?php
// admin/api_admin.php
require_once '../includes/config.php';
requireAdmin();
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) { echo json_encode(['success'=>false,'message'=>'Dados inválidos']); exit; }

$db = getDB();
$acao = $input['acao'] ?? '';
$id = intval($input['id'] ?? 0);

switch ($acao) {
    case 'aprovar':
        $stmt = $db->prepare("UPDATE candidaturas SET status='aprovado', admin_id=? WHERE id=?");
        $ok = $stmt->execute([$_SESSION['admin_id'], $id]);
        echo json_encode(['success' => $ok]);
        break;

    case 'rejeitar':
        $motivo = sanitize($input['motivo'] ?? '');
        $stmt = $db->prepare("UPDATE candidaturas SET status='rejeitado', motivo_rejeicao=?, admin_id=? WHERE id=?");
        $ok = $stmt->execute([$motivo, $_SESSION['admin_id'], $id]);
        echo json_encode(['success' => $ok]);
        break;

    case 'eliminar_candidatura':
        $stmt = $db->prepare("DELETE FROM candidaturas WHERE id=?");
        $ok = $stmt->execute([$id]);
        echo json_encode(['success' => $ok]);
        break;

    case 'alterar_status':
        $status = $input['status'] ?? '';
        $allowed = ['pendente','pagamento_pendente','em_analise','aprovado','rejeitado'];
        if (!in_array($status, $allowed)) { echo json_encode(['success'=>false,'message'=>'Estado invalido']); break; }
        $stmt = $db->prepare("UPDATE candidaturas SET status=?, admin_id=? WHERE id=?");
        $ok = $stmt->execute([$status, $_SESSION['admin_id'], $id]);
        echo json_encode(['success' => $ok]);
        break;

    case 'mudar_status':
        $status = $input['status'] ?? '';
        $allowed = ['pendente','pagamento_pendente','em_analise','aprovado','rejeitado'];
        if (!in_array($status, $allowed)) { echo json_encode(['success'=>false,'message'=>'Estado inválido']); break; }
        $stmt = $db->prepare("UPDATE candidaturas SET status=?, admin_id=? WHERE id=?");
        $ok = $stmt->execute([$status, $_SESSION['admin_id'], $id]);
        echo json_encode(['success' => $ok]);
        break;

    case 'notas':
        $notas = sanitize($input['notas'] ?? '');
        $stmt = $db->prepare("UPDATE candidaturas SET notas_admin=? WHERE id=?");
        $ok = $stmt->execute([$notas, $id]);
        echo json_encode(['success' => $ok]);
        break;

    case 'publicar_evento':
        $pub = intval($input['publicado'] ?? 0);
        $stmt = $db->prepare("UPDATE eventos SET publicado=? WHERE id=?");
        $ok = $stmt->execute([$pub, $id]);
        echo json_encode(['success' => $ok]);
        break;

    case 'salvar_evento':
        $titulo = sanitize($input['titulo'] ?? '');
        $descricao = sanitize($input['descricao'] ?? '');
        $data = sanitize($input['data_evento'] ?? '');
        $hora = sanitize($input['hora_evento'] ?? '');
        $local = sanitize($input['local_evento'] ?? '');
        $publicado = intval($input['publicado'] ?? 0);
        $destaque = intval($input['destaque'] ?? 0);

        if ($id > 0) {
            $stmt = $db->prepare("UPDATE eventos SET titulo=?,descricao=?,data_evento=?,hora_evento=?,local_evento=?,publicado=?,destaque=? WHERE id=?");
            $ok = $stmt->execute([$titulo,$descricao,$data,$hora,$local,$publicado,$destaque,$id]);
        } else {
            $stmt = $db->prepare("INSERT INTO eventos (titulo,descricao,data_evento,hora_evento,local_evento,publicado,destaque,criado_por) VALUES (?,?,?,?,?,?,?,?)");
            $ok = $stmt->execute([$titulo,$descricao,$data,$hora,$local,$publicado,$destaque,$_SESSION['admin_id']]);
            $id = $db->lastInsertId();
        }
        echo json_encode(['success' => $ok, 'id' => $id]);
        break;

    case 'deletar_evento':
        $stmt = $db->prepare("DELETE FROM eventos WHERE id=?");
        $ok = $stmt->execute([$id]);
        echo json_encode(['success' => $ok]);
        break;

    default:
        echo json_encode(['success'=>false,'message'=>'Ação desconhecida']);
}
