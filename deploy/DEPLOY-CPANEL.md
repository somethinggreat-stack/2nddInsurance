# Deploying to cPanel (zip upload, no terminal) — patrickyassoinsurance.com

This project is production-ready. Follow these steps to go live on cPanel.

## 1. Database (phpMyAdmin)
You already created:
- DB: `patricky_patrick`  ·  User: `patricky_patrickuser`  ·  Password: `nYeBaU4@ekqWuiQ`

Now:
1. cPanel → **MySQL Databases** → under *"Add User To Database"*, add `patricky_patrickuser`
   to `patricky_patrick` with **ALL PRIVILEGES**. (Critical — without this the site can't connect.)
2. cPanel → **phpMyAdmin** → select `patricky_patrick` → **SQL** tab →
   paste the contents of **`deploy/database.sql`** → **Go**.

## 2. PHP version
cPanel → **MultiPHP Manager** → set the domain to **PHP 8.1, 8.2, or 8.3**.
(Extensions pdo_mysql, mbstring, openssl, curl, fileinfo are on by default.)

## 3. Upload the files
1. Before zipping, delete these (test data / not needed in production):
   - `database/database.sqlite`
   - `storage/logs/laravel.log`
2. **Zip the entire project folder** — IMPORTANT: include the **`vendor/`** folder and the
   **`.env`** file (the server has no Composer, so vendor must be uploaded).
3. cPanel → **File Manager** → upload the zip into **`public_html`** → **Extract**.
   (If the files extract into a subfolder, move them so they sit directly in `public_html`.)

The included **root `.htaccess`** automatically routes traffic into `/public` and blocks
access to `.env`, `app/`, `storage/`, etc.

> **Cleaner alternative (recommended if available):** instead of the root .htaccess,
> point the domain's **Document Root** to `.../public_html/public` (cPanel → Domains →
> manage → Document Root). Then the root .htaccess isn't needed.

## 4. Permissions
In File Manager, set these folders to **755** (writable) and apply recursively:
- `storage/`
- `bootstrap/cache/`

## 5. SSL / HTTPS
cPanel → **SSL/TLS Status** → run **AutoSSL** for patrickyassoinsurance.com.
The `.htaccess` already forces HTTPS. *(If SSL isn't active yet, temporarily comment out the
3 "Force HTTPS" lines in both `.htaccess` files to avoid a redirect loop, then re-enable.)*

## 6. Go live
Visit **https://patrickyassoinsurance.com** — done.
- Admin dashboard: **/admin/login** (email + password from `.env`).
- Test a form; Patrick gets the notification email + the lead gets the confirmation.

## Notes
- `.env` already has the live MySQL credentials, `APP_URL`, Gmail SMTP, and admin login.
- All page/email buttons use the domain automatically (relative/route-based links).
- Forms are protected by honeypots + rate limiting (8/min per IP).
- To update later: re-zip and re-upload (keep the server's `.env`).
