# Project Ontwikkelingsplan: PinNews CMS

Dit document beschrijft de chronologische opbouw van het project, precies zoals een senior developer te werk zou gaan. Elke fase is opgedeeld in kleine, logische stappen die strict de architectuur en vereisten uit `rules.md` volgen. 

**Hoofdregel voor elke stap:** Na het afronden van de code wordt er **ALTIJD** direct getest met Pest (Unit of Feature test) voordat we naar de volgende stap gaan. Geen enkele PR of functionaliteit wordt als afgerond beschouwd zonder een bijhorende groene test.

---

## Fase 1: Fundering & Database (Backend First)

### Stap 1.1: Project Configuraties & Architectuur Setup
- [x] Zorg ervoor dat de Laravel 13 en Livewire 4 setup correct werkt.
- [x] Maak de mappenstructuur aan volgens het domain-driven design (bijv. `app/Actions`, `app/Enums`, `app/Services`).
- [x] Definieer Enums: `ArticleStatus` (Draft, Published) en `UserRole` (Admin, User).
- [x] **Test (Pest):** Basic setup tests (check of Enums de juiste waarden retourneren en basis routes laden).

### Stap 1.2: Database Migraties & Models
- [x] Maak de migraties voor `users` (aanpassen met role_id of role enum).
- [x] Maak de migratie voor `categories` (id, name, slug, description, timestamps).
- [x] Maak de migratie voor `articles` (id, title, slug, excerpt, content, image, category_id, author_id, is_published/status, published_at, views, timestamps, softDeletes).
- [x] Voeg de indexen toe op `slug`, `published_at`, en `category_id`.
- [x] Maak de bijhorende Eloquent Models met de juiste relaties (`belongsTo`, `hasMany`) en typed properties.
- [x] **Test (Pest):** Test de database schema's, controleer of mass-assignment beveiligd is en test de foreign keys.

### Stap 1.3: Policies & Autorisatie
- [x] Maak `ArticlePolicy` en `CategoryPolicy`.
- [x] Stel de rules in: Admins hebben full access, reguliere users kunnen alleen hun eigen artikelen aanpassen/inzien (indien dit in de toekomst gebruikt wordt).
- [x] **Test (Pest):** Policy tests met Pest: verifieer dat een non-admin geen article van iemand anders mag updaten.

### Stap 1.4: Factories & Seeders
- [x] Ontwikkel `UserFactory`, `CategoryFactory` en `ArticleFactory`.
- [x] Maak een `DatabaseSeeder` om een realistisch ogende demo database op te zetten:
  - [x] 1 Admin user.
  - [x] Categorieën zoals Technologie, Architectuur, Fotografie en Design.
  - [x] 30-40 Artikelen verspreid over deze categorieën (mix van drafts en published, met dummy Unsplash afbeeldingen).
- [x] **Test (Pest):** Verifieer dat na het runnen van de seeders de database het verwachte aantal records bevat en relaties intact zijn.

---

## Fase 2: Frontend Integratie & Layouts

### Stap 2.1: Tailwind, Vite & Base Layout Setup
- [x] Kopieer de specifieke Tailwind instellingen uit `test.zip` (`pin-red`, `plum-black`, `border-radius` etc.) naar `vite.config.js` of `tailwind.config.js`.
- [x] Installeer GSAP via npm (om CDN in productie te voorkomen).
- [x] Creëer de basis layout in `resources/views/components/layouts/app.blade.php`.
- [x] Plaats hierin de herbruikbare header/navigatie balk (zoals te zien in de test.zip bestanden).
- [x] **Test (Pest):** HTTP test die controleert of de algemene layout (of de header component) een `200 OK` status returnt.

### Stap 2.2: Implementatie Homepage (`index.html`)
- [x] Maak de full-page Livewire component: `Livewire\Pages\Home\Index`.
- [x] Integreer het uitgelichte artikel (hero banner) en de 'Trending Vandaag' sectie (masonry grid).
- [x] Gebruik eager loading in de query om N+1 problemen te voorkomen bij het inladen van de category en author.
- [x] **Test (Pest):** Test dat de component de meest recente/uitgelichte artikelen injecteert in de view en N+1 veilig is.

### Stap 2.3: Implementatie Nieuws Overzicht (`nieuws.html`)
- [x] Maak de component: `Livewire\Pages\News\Index`.
- [x] Zet de masonry grid op voor de "Ontdekken" pagina.
- [x] Implementeer de Livewire trait `WithPagination`.
- [x] **Test (Pest):** Controleer of de paginering juist werkt via Pest (verifieer het aantal getoonde artikelen per pagina).

---

## Fase 3: Artikel Detailpagina & SEO

### Stap 3.1: Artikel Detail Component (`artikel.html`)
- [x] Maak `Livewire\Pages\Article\Show`.
- [x] Gebruik Route Model Binding met behulp van de slug in plaats van de ID in de routes (`Route::get('/artikel/{article:slug}')`).
- [x] Toon de specifieke content, de auteur, datum en verhoog de view counter telkens wanneer het artikel geladen wordt.
- [x] Implementeer design nuances (zoals de "Vond je dit interessant?" call to action onderaan).
- [x] **Test (Pest):** Verifieer of de slug routing werkt. Test ook of de `views` count van een artikel correct met +1 wordt verhoogd als de pagina opgevraagd wordt.

### Stap 3.2: SEO Optimalisatie
- [x] Maak een `SeoService` die aan de layout of de `Show` component gekoppeld wordt.
- [x] Vul de Meta Title, Meta Description en OpenGraph (og:image, og:title) dynamisch in, op basis van de artikel titel en het excerpt.
- [x] **Test (Pest):** Verifieer dat bij het opvragen van de detailpagina de resulterende HTML de juiste `<meta>` tags bevat.

---

## Fase 4: Admin CMS Backend

### Stap 4.1: Admin Layout & Dashboard Setup
- [x] Maak een vereenvoudigde Admin layout (kan een apart `admin.blade.php` layout bestand zijn).
- [x] Beveilig de Admin route group met een middleware en policy (enkel voor Admins).
- [x] Maak een overzichts dashboard: `Livewire\Pages\Admin\Dashboard`.
- [x] **Test (Pest):** Controleer de security: een guest of gewone user mag geen toegang krijgen en ontvangt een 403 of 302.

### Stap 4.2: Categorieën Beheren (CRUD)
- [x] Maak acties (`app/Actions/Categories/`): `CreateCategoryAction`, `UpdateCategoryAction`.
- [x] Maak een Livewire component voor het oplijsten van categorieën en een form component voor aanmaak/wijziging.
- [x] Gebruik `#[Validate]` regels voor unieke slugs en verplichte velden.
- [x] **Test (Pest):** Test de Actions in isolatie met Pest (Unit), test daarna de Livewire form validaties (Feature).

### Stap 4.3: Artikels Beheren (CRUD)
- [x] Maak acties (`app/Actions/Articles/`): `CreateArticleAction`, `UpdateArticleAction`, `PublishArticleAction`, `DeleteArticleAction`.
- [x] Maak het uitgebreide artikel formulier in Livewire.
- [x] Voorzie functionaliteit voor afbeeldings-uploads (gebruik `ImageService` voor het processen/saven van beelden).
- [x] Koppel het veld voor drafts en publishing met de Enum `ArticleStatus`.
- [x] **Test (Pest):** Test de file uploads in Pest (met `Storage::fake('public')`). Verifieer dat artikelen veilig kunnen worden opgeslagen en geüpdatet.

---

## Fase 5: Interactie & Filters (Frontend Polish)

### Stap 5.1: Zoekfunctionaliteit
- [x] Maak een Action: `SearchArticlesAction` (geïmplementeerd direct in Livewire component voor performance).
- [x] Koppel de zoekbalk uit de top-navigatie aan de `Livewire\Pages\News\Index` pagina.
- [x] **Test (Pest):** Test in de test-database of zoeken op een specifiek keyword enkel de relevante artikelen retourneert.

### Stap 5.2: Categorie Filters
- [x] Maak de filterknoppen (Technologie, Architectuur, etc.) uit `nieuws.html` dynamisch gestuurd.
- [x] Gebruik Livewire computed properties (`#[Computed]`) om te tonen welke artikelen gefilterd worden.
- [x] Zorg dat dit vloeiend werkt zonder volledige page-refreshes (Livewire navigatie/SPA feeling).
- [x] **Test (Pest):** Zorg voor Pest tests die de filter selectie in Livewire component simuleert en checkt of de lijst met artikelen update.

---

## Fase 6: Afronding & Review

### Stap 6.1: Code Cleanup
- [x] Controleer en verwijder alle dummy en ongebruikte componenten.
- [x] Valideer de code tegen verouderde Livewire patronen. Alles is strikt Livewire 4.
- [x] Controleer dat er geen business logica in Blade of Views staat.

### Stap 6.2: Volledige Regressietest
- [x] Voer `pest` uit. De test coverage is groen en uitgebreid (58 tests passed).
- [x] Controleer of alle views en assets via Vite gebundeld zijn.

> **Project Afgerond:** Het CMS is volledig functioneel, responsive en voorzien van moderne animaties en SEO optimalisaties.

