# Deploying to a Windows VPS

This guide puts the site online on your Windows VPS for a client preview link.
Run everything **on the VPS** (via RDP).

## 0. Get the code onto the VPS

Either clone from GitHub:
```powershell
cd C:\sites
git clone https://github.com/umairarshad123/insurance.git yasso-insurance
cd yasso-insurance
```
…or copy the project folder over RDP (zip it, paste it into e.g. `C:\sites\yasso-insurance`).

## 1. Install prerequisites on the VPS (once)

- **PHP 8.1+** — easiest is **XAMPP** (https://www.apachefriends.org) which gives you PHP + Apache.
- **Composer** — https://getcomposer.org/Composer-Setup.exe

## 2. One-command app setup

From the project folder:
```powershell
powershell -ExecutionPolicy Bypass -File deploy\vps-setup.ps1
```
This installs dependencies, creates `.env`, generates the key, sets up the SQLite
database, runs migrations, and caches config/routes/views.

Then edit **`.env`**:
- `APP_URL=` your preview URL (e.g. `http://YOUR_VPS_IP` or `http://preview.yourdomain.com`)
- `ADMIN_PASSWORD=` a strong password (for the `/admin` dashboard)

---

## 3. Serve it — pick ONE

### Option A — Quick preview (fastest, 2 minutes)
```powershell
C:\xampp\php\php.exe artisan serve --host=0.0.0.0 --port=8000
```
Open the firewall, then share **http://YOUR_VPS_IP:8000**
```powershell
New-NetFirewallRule -DisplayName "Laravel 8000" -Direction Inbound -Protocol TCP -LocalPort 8000 -Action Allow
```
(To keep it running 24/7, run it as a scheduled task or use NSSM to make it a service.)

### Option B — XAMPP Apache on port 80 (clean URL, recommended)
1. Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf`, add:
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/sites/yasso-insurance/public"
       ServerName preview.yourdomain.com
       <Directory "C:/sites/yasso-insurance/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```
2. Start Apache from the XAMPP Control Panel.
3. Open firewall TCP 80 (and 443 for HTTPS):
   ```powershell
   New-NetFirewallRule -DisplayName "HTTP 80" -Direction Inbound -Protocol TCP -LocalPort 80 -Action Allow
   New-NetFirewallRule -DisplayName "HTTPS 443" -Direction Inbound -Protocol TCP -LocalPort 443 -Action Allow
   ```
4. Visit **http://YOUR_VPS_IP** (or your subdomain).

### Option C — IIS
Install: IIS + **PHP Manager** + **URL Rewrite** module. Point a site at the
`public` folder, set PHP via FastCGI, and add Laravel's rewrite rules. (More setup
than XAMPP — use A or B for a quick client preview.)

---

## 4. Domain + HTTPS (optional, nicer link)
- Add a DNS **A record**: `preview` → `YOUR_VPS_IP`.
- For free HTTPS: use **win-acme** (https://www.win-acme.com) to issue a Let's Encrypt
  certificate for `preview.yourdomain.com` on IIS, or Cloudflare in front for instant HTTPS.

## 5. Updating the site later
```powershell
git pull
powershell -ExecutionPolicy Bypass -File deploy\vps-setup.ps1
```

## Admin dashboard
`/admin/login` — password = `ADMIN_PASSWORD` from `.env`. All leads land here.
