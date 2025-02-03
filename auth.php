<?php
if (isset($_GET['hash'])) {
    $data = $_GET;
    $secret_key = hash('sha256', '8010326369:AAFsNSsL-VyX1NKPgLGNEIem9I8O6ZKGDB0', true);
    $check_string = implode("\n", [
        "auth_date={$data['auth_date']}",
        "first_name={$data['first_name']}",
        "id={$data['id']}",
        "username={$data['username']}"
    ]);

    if (hash_hmac('sha256', $check_string, $secret_key) === $data['hash']) {
        echo "Hello, " . htmlspecialchars($data['first_name']);
    } else {
        die("Invalid data");
    }
} else {
    die("No data");
}
