<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$error = '';

// POST送信があったらログイン処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 正しいログイン情報
    $correct_email = 'admin@sample';
    $correct_password = 'admin';

    if ($email === $correct_email && $password === $correct_password) {
        $_SESSION['user'] = [
            'email' => $email,
            'role' => 'admin'
        ];
        header('Location: index.php');
        exit;
    } else {
        $error = 'ユーザー情報が正しくありません';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>管理者ログイン</h1>
        </header>

        <?php if ($error): ?>
            <div class="flash-message" style="background-color:#f8d7da; border-color:#f5c6cb; color:#721c24;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="form" class="form form-horizontal">
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn">ログイン</button>
        </form>

        <div style="margin-top: 40px; font-size: 0.9rem; color: #666;">
            <p><strong>ログイン情報</strong></p>
            <p>ID: admin@sample<br>
                password: admin</p>
        </div>
    </div>
</body>

</html>