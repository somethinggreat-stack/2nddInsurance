# Patrick Yasso Insurance — Premium Funnel Website

A high-converting insurance funnel built in **Laravel 10** for Patrick Yasso, a Farmers
Insurance agent in Walled Lake, Michigan. Hand-crafted premium design, multi-step
questionnaire, full lead capture, SEO, and a built-in lead dashboard.

---

## Running the site locally

PHP 8.3 is installed at `C:\php83`. From this folder (`yasso-insurance`):

```bash
# start the dev server
C:\php83\php.exe artisan serve --host=127.0.0.1 --port=8000
```

Then open **http://127.0.0.1:8000**

Composer commands use the same PHP:
`& "C:\php83\php.exe" "C:\ProgramData\ComposerSetup\bin\composer.phar" <command>`

---

## Lead Dashboard (admin)

- URL: **http://127.0.0.1:8000/admin/login**
- Password: set in `.env` as `ADMIN_PASSWORD` (default `yasso-admin-2026`).

From the dashboard you can view, filter, search, status-track, export (CSV), and delete leads.
Every quote, contact, callback, consultation, and questionnaire submission lands here.

---

## Editing content (no coding needed)

**Almost all text and business info lives in one file:** `config/site.php`

- Phone, email, address, license, hours, social links
- Services / insurance products (titles, descriptions, bullet points)
- "Why choose us" reasons, process steps
- Testimonials (⚠️ replace the sample reviews with real, verified client reviews)
- FAQs (questions + answers)
- Headline stats (years of experience, clients served — update to real numbers)
- Coverage areas

After editing, refresh the page. (If cached: `C:\php83\php.exe artisan config:clear`)

Brand colors and styling: `public/css/app.css` (top of file = color variables).
Images (logo, headshot, social share image): `public/images/`.

---

## Email notifications

New leads are emailed to `LEAD_NOTIFY_EMAIL` in `.env`.
By default `MAIL_MAILER=log` (emails are written to `storage/logs/laravel.log` instead of
being sent). To send real emails, set your SMTP details in `.env` and change `MAIL_MAILER=smtp`.

---

## Pages

Home · About · Insurance Products · Services · Why Choose Us · Testimonials · FAQ ·
Contact · Get a Quote · Schedule a Consultation · Multi-step Questionnaire · Thank You ·
Privacy Policy · Terms · `sitemap.xml`

## Conversion features

Sticky mobile CTA · floating contact button · exit-intent popup · click-to-call/text ·
multi-step questionnaire with progress + validation + review · honeypot spam protection.

## SEO

Per-page titles/descriptions, Open Graph + Twitter cards, JSON-LD (LocalBusiness +
FAQ schema), canonical URLs, sitemap.xml, semantic headings, alt text, fast load (no build step).

---

## Before going live — checklist

- [ ] Replace **sample testimonials** in `config/site.php` with real, verified reviews.
- [ ] Update **stats** (years of experience, clients protected) to accurate figures.
- [ ] Add real **social media links** in `config/site.php`.
- [ ] Have **Privacy Policy** & **Terms** reviewed by legal / Farmers compliance.
- [ ] Set a strong `ADMIN_PASSWORD` and real **SMTP** settings in `.env`.
- [ ] Set `APP_ENV=production`, `APP_DEBUG=false`, and your real domain in `APP_URL`.
- [ ] Confirm usage of the Farmers logo/marks complies with Farmers brand guidelines.

---

Built on Laravel 10 · SQLite · hand-crafted CSS/JS (no build step required).
