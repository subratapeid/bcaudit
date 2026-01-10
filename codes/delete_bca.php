<?php
include "../include/auth.php";
require_once 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['bca_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid BCA ID'
    ]);
    exit;
}

$bcaId = $data['bca_id'];

try {
    $stmt = $pdo->prepare("DELETE FROM all_bc_details WHERE bca_id = ?");
    $stmt->execute([$bcaId]);

    if ($stmt->rowCount()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Record not found'
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Delete failed'
    ]);
}
