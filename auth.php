<?php
require 'db.php';

if (isset($_GET['hash'])) {
    $data = $_GET;
    $secret_key = hash('sha256', '8010326369:AAFsNSsL-VyX1NKPgLGNEIem9I8O6ZKGDB0', true);

    // Проверяем подпись данных от Telegram
    $check_string = implode("\n", [
        "auth_date={$data['auth_date']}",
        "first_name={$data['first_name']}",
        "id={$data['id']}",
        "username={$data['username']}"
    ]);

    if (hash_hmac('sha256', $check_string, $secret_key) === $data['hash']) {
        // Добавляем пользователя в базу данных
        $stmt = $pdo->prepare("INSERT INTO users (telegram_id, first_name, username) 
                               VALUES (:telegram_id, :first_name, :username)
                               ON DUPLICATE KEY UPDATE first_name=:first_name");
        $stmt->execute([
            'telegram_id' => $data['id'],
            'first_name' => $data['first_name'],
            'username' => $data['username']
        ]);

        header("Location: index.html"); // Перенаправляем на главную страницу приложения
    } else {
        die("Ошибка: данные невалидны.");
    }
} else {
    die("Ошибка: нет данных.");
}
?>
