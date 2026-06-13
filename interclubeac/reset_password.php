<?php
// reset_password.php
// APAGUE ESTE FICHEIRO APÓS USAR!
require_once 'includes/config.php';

$novaPassword = 'Admin@2024';
$hash = password_hash($novaPassword, PASSWORD_DEFAULT);

$db = getDB();

// Verificar se o admin existe
$check = $db->query("SELECT COUNT(*) FROM admins")->fetchColumn();

if ($check == 0) {
    // Inserir admin se não existir
    $stmt = $db->prepare("INSERT INTO admins (nome, email, password, nivel) VALUES (?, ?, ?, 'super_admin')");
    $stmt->execute(['Super Admin', 'admin@interclubeac.ao', $hash]);
    echo "<p style='color:green'>✅ Admin criado com sucesso!</p>";
} else {
    // Actualizar password
    $stmt = $db->prepare("UPDATE admins SET password = ? WHERE email = 'admin@interclubeac.ao'");
    $stmt->execute([$hash]);
    echo "<p style='color:green'>✅ Password actualizada com sucesso!</p>";
}

echo "<p><strong>Email:</strong> admin@interclubeac.ao</p>";
echo "<p><strong>Password:</strong> Admin@2024</p>";
echo "<p style='color:red'>⚠️ APAGUE este ficheiro agora: <code>reset_password.php</code></p>";
echo "<p><a href='admin/login.php'>→ Ir para o Login</a></p>";
?>
