<?php
$access_token = '8010326369:AAFsNSsL-VyX1NKPgLGNEIem9I8O6ZKGDB0'; // Замените на токен вашего бота из BotFather
$api = 'https://api.telegram.org/bot' . $access_token;

$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$message = $output['message']['text'];

if ($message == '/start') {
    sendMessage($chat_id, "Привет, это IPPACH! Зайди в приложение: https://askirya.github.io/index.html");
}

function sendMessage($chat_id, $text) {
    global $api;
    file_get_contents($api . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($text));
}
?>
