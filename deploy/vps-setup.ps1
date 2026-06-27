<#
  Patrick Yasso Insurance — VPS setup script (run ON the Windows VPS)
  --------------------------------------------------------------------
  Usage (PowerShell, inside the project folder):
      powershell -ExecutionPolicy Bypass -File deploy\vps-setup.ps1

  It will: locate PHP + Composer, install dependencies, create .env,
  generate the app key, set up the SQLite database, run migrations,
  and cache config/routes/views for production.

  Prerequisites on the VPS:
   - PHP 8.1+  (XAMPP's php, or php.net build, or Laravel Herd)
   - Composer  (https://getcomposer.org)
#>

$ErrorActionPreference = "Stop"
$root = Split-Path -Parent $PSScriptRoot   # project root (deploy\ is inside it)
Set-Location $root
Write-Host "Project root: $root" -ForegroundColor Cyan

# --- 1. Locate PHP -------------------------------------------------------
function Find-Php {
    $cmd = Get-Command php -ErrorAction SilentlyContinue
    if ($cmd) { return $cmd.Source }
    $candidates = @(
        "C:\xampp\php\php.exe",
        "C:\php\php.exe",
        "C:\php83\php.exe",
        "$env:USERPROFILE\.config\herd\bin\php.exe"
    )
    foreach ($c in $candidates) { if (Test-Path $c) { return $c } }
    return $null
}
$php = Find-Php
if (-not $php) { Write-Host "PHP not found. Install PHP 8.1+ (XAMPP or php.net) and re-run." -ForegroundColor Red; exit 1 }
Write-Host "PHP: $php" -ForegroundColor Green
& $php -v | Select-Object -First 1

# --- 2. Locate Composer --------------------------------------------------
$composer = (Get-Command composer -ErrorAction SilentlyContinue).Source
$composerPhar = "C:\ProgramData\ComposerSetup\bin\composer.phar"
function Invoke-Composer($composerArgs) {
    if ($composer) { & $php $composer @composerArgs }
    elseif (Test-Path $composerPhar) { & $php $composerPhar @composerArgs }
    else { Write-Host "Composer not found. Install from https://getcomposer.org" -ForegroundColor Red; exit 1 }
}

# --- 3. Install dependencies --------------------------------------------
Write-Host "`nInstalling Composer dependencies (production)..." -ForegroundColor Cyan
Invoke-Composer @("install", "--no-dev", "--optimize-autoloader", "--no-interaction")

# --- 4. Environment ------------------------------------------------------
if (-not (Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
    Write-Host "Created .env from .env.example  (edit ADMIN_PASSWORD + APP_URL!)" -ForegroundColor Yellow
}
& $php artisan key:generate --force

# --- 5. Database (SQLite) ------------------------------------------------
if (-not (Test-Path "database\database.sqlite")) {
    New-Item -ItemType File -Path "database\database.sqlite" | Out-Null
    Write-Host "Created database\database.sqlite" -ForegroundColor Green
}
& $php artisan migrate --force

# --- 6. Optimize ---------------------------------------------------------
& $php artisan storage:link 2>$null
& $php artisan config:cache
& $php artisan route:cache
& $php artisan view:cache

Write-Host "`n========================================================" -ForegroundColor Green
Write-Host " Setup complete." -ForegroundColor Green
Write-Host "========================================================`n"
Write-Host "NEXT — choose how to serve it:`n"
Write-Host "  QUICK PREVIEW (fastest):" -ForegroundColor Cyan
Write-Host "    $php artisan serve --host=0.0.0.0 --port=8000"
Write-Host "    Then open Windows Firewall TCP 8000 -> http://YOUR_VPS_IP:8000`n"
Write-Host "  PRODUCTION: point Apache (XAMPP) or IIS at the 'public' folder."
Write-Host "    See deploy\DEPLOY.md for the full vhost + firewall + domain guide.`n"
Write-Host "  IMPORTANT: edit .env -> set a strong ADMIN_PASSWORD and APP_URL." -ForegroundColor Yellow
