# Laravel Cloud Deployment Plan: PinNews CMS

Dit document bevat de stappen om het project te pushen naar GitHub en vervolgens te lanceren op **Laravel Cloud**.

## Fase 1: GitHub Repository Setup

- [ ] Ga naar [github.com/syntraprogrammeurs](https://github.com/syntraprogrammeurs) en maak een nieuwe repository aan met de naam `nieuwssite`.
- [ ] Zorg dat de repository **Public** of **Private** is (jouw keuze).
- [ ] Voeg géén README, .gitignore of licentie toe op GitHub (we hebben deze al lokaal).

## Fase 2: Lokale Git Initialisatie & Push

- [ ] Open je terminal in de root van je project (`c:\wamp64\www\nieuwssite\nieuwssite`).
- [ ] Initialiseer git: `git init`
- [ ] Voeg alle bestanden toe: `git add .`
- [ ] Maak je eerste commit: `git commit -m "Initial commit: PinNews CMS v1.0"`
- [ ] Maak de `main` branch aan: `git branch -M main`
- [ ] Koppel de remote repository: `git remote add origin https://github.com/syntraprogrammeurs/nieuwssite.git`
- [ ] Push je code: `git push -u origin main`

## Fase 3: Laravel Cloud Configuratie

- [ ] Log in op [cloud.laravel.com](https://cloud.laravel.com).
- [ ] Koppel je GitHub account (indien nog niet gedaan).
- [ ] Klik op **"Create New Project"**.
- [ ] Selecteer de repository `syntraprogrammeurs/nieuwssite`.
- [ ] Kies je regio en plan (bijv. "Hobby" of "Pro").

## Fase 4: Environment & Database Setup

- [ ] Ga naar de **Environment Variables** in Laravel Cloud.
- [ ] Zorg dat de volgende variabelen correct zijn ingesteld:
  - `APP_KEY`: (Kopieer uit je lokale `.env`)
  - `APP_ENV`: `production`
  - `APP_DEBUG`: `false`
  - `APP_URL`: (De URL die Laravel Cloud je geeft)
- [ ] **Database:** Laravel Cloud configureert meestal automatisch een database voor je. Controleer of de `DB_CONNECTION` en andere `DB_` variabelen door het platform zijn ingevuld.
- [ ] **Storage:** Zorg dat `FILESYSTEM_DISK` op `public` of een cloud opslag (S3) staat als je persistentie nodig hebt voor afbeeldingen.

## Fase 5: Deployment & Lancering

- [ ] Klik op **"Deploy"** in het Laravel Cloud dashboard.
- [ ] Controleer de **Build Logs** op eventuele errors (bijv. Vite build of Composer install).
- [ ] Zodra de build klaar is, voer de migraties uit via de console in het dashboard:
  - `php artisan migrate --force`
- [ ] (Optioneel) Voer de seeder uit voor demo data:
  - `php artisan db:seed --force`
- [ ] Maak de storage link aan (indien nodig op Laravel Cloud):
  - `php artisan storage:link`

## Fase 6: Finale Check

- [ ] Bezoek de live URL.
- [ ] Test de zoekfunctie en categorie-filters.
- [ ] Test het inloggen op het `/dashboard` pad.
- [ ] Controleer of de afbeeldingen (Unsplash) correct laden op de live server.

---

> **Tip:** Laravel Cloud handelt SSL certificaten (HTTPS) en automatische deployments bij elke nieuwe `git push` automatisch voor je af.
