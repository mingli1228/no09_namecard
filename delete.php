<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('funcs.php');

// --- 管理者チェック ---
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    // 管理者でなければ一覧に戻す（削除はさせない）
    header("Location: index.php");
    exit;
}

$pdo = db_conn();

$id = $_POST['id'] ?? null;

if ($id !== null && is_numeric($id)) {
    $stmt = $pdo->prepare("DELETE FROM db_namecard WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// 削除完了後にindex.phpに戻す（フラッシュ付き）
header("Location: index.php?status=deleted");
exit;
