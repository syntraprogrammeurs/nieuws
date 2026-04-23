# rules.md (nieuw project – PinNews CMS)

## Doel van dit document
Dit document is de vaste bouw- en schrijfrichtlijn voor dit project in VS Code. Alles wat gegenereerd, aangepast of voorgesteld wordt, moet compatibel zijn met:

- Laravel 13  
- Livewire 4  
- de officiële Laravel Livewire starter kit  
- Tailwind (via Vite, niet via CDN in productie)  
- MySQL of MariaDB  
- Pest  

Dit project is een **nieuwsplatform (CMS)** gebouwd op basis van de frontend uit `test.zip` (PinNews).

---

## Projectcontext

### Startpunt
- Laravel 13 + Livewire 4 is reeds geïnstalleerd  
- Starter kit is aanwezig  
- `test.zip` bevat de volledige frontend  
- Frontend bevat:
  - homepage (`index.html`)
  - nieuws overzicht (`nieuws.html`)
  - artikel detail (`artikel.html`)

### Hoofddoel
Bouw een **modern nieuws CMS** met:

- publieke nieuwssite (Pinterest-stijl layout)
- artikels met detailpagina
- categorieën / topics
- zoek + filtering
- admin backend voor contentbeheer
- gebruikers (optioneel)
- schaalbare architectuur

---

## Niet-onderhandelbare regels

### Verboden
Gebruik nooit:

- oude Livewire syntax  
- `Volt::route()`  
- Vue / React / Inertia  
- business logic in Blade  
- queries in views  
- float voor cijfers  
- mock data als eindoplossing  
- CDN Tailwind in productie  

### Verplicht
Gebruik:

- `Route::livewire()`  
- Livewire single-file components  
- Actions  
- Services  
- Enums  
- Policies  
- eager loading  
- typed properties  

---

## Livewire 4 regels

### Componentstrategie

Gebruik:

- full-page Livewire voor pagina’s:
  - home
  - nieuws overzicht
  - artikel detail
- kleine componenten voor:
  - cards
  - filters
  - search

### Componentregels

Elke component:

- heeft 1 verantwoordelijkheid  
- bevat geen business logic  
- gebruikt:
  - `#[Computed]`
  - `#[Validate]`
  - `WithPagination`

---

## Laravel architectuur

### Lagen

#### Routes
Alleen routing

#### Controllers
Dun houden

#### Livewire
Frontend interactie

#### Actions
Voorbeeld:

- `CreateArticleAction`
- `UpdateArticleAction`
- `PublishArticleAction`
- `DeleteArticleAction`
- `SearchArticlesAction`

#### Services

- `ArticleService`
- `ImageService`
- `SeoService`

---

## Domeinstructuur

Gebruik:

app/
├── Actions/
│   ├── Articles/
│   ├── Categories/
├── Enums/
├── Livewire/
│   ├── Pages/
│   │   ├── Home/
│   │   ├── News/
│   │   ├── Article/
│   │   └── Admin/
├── Models/
├── Policies/
├── Services/

---

## Frontend analyse (test.zip)

De frontend toont duidelijk een **Pinterest-like nieuwsplatform**:

### Pagina’s

#### index.html
- hero + trending
- grid layout met cards

#### nieuws.html
- discover pagina
- infinite scroll / grid
- filters

#### artikel.html
- detailpagina
- titel
- content
- auteur
- datum

---

## CMS structuur

### Article

Velden:

- id  
- title  
- slug  
- excerpt  
- content  
- image  
- category_id  
- author_id  
- is_published  
- published_at  
- views  
- timestamps  
- soft deletes  

---

### Category

- id  
- name  
- slug  
- description  
- timestamps  

---

### User

- id  
- name  
- email  
- role  
- timestamps  

---

## Database regels

### Slugs
- uniek  
- gebruikt in routes  

### Indexes
- slug  
- published_at  
- category_id  

### Soft deletes
- articles  

---

## Enums

Gebruik:

- `ArticleStatus`
- `UserRole`

---

## Policies

- admin → full access  
- user → enkel eigen content  

---

## Nieuwsfunctionaliteit

### 1. Homepage

Livewire pagina:

- trending articles  
- recente artikels  
- featured  

---

### 2. Nieuws overzicht

Features:

- pagination  
- search  
- category filter  
- sort (nieuwste / populairste)  

---

### 3. Artikel detail

Features:

- slug route  
- volledige content  
- auteur info  
- publicatiedatum  
- view counter  

---

## SEO regels

- slug gebaseerd op title  
- meta title  
- meta description  
- OpenGraph tags  

---

## Admin CMS

### Artikels beheren

- create  
- edit  
- publish/unpublish  
- delete  

### Categorieën

- CRUD  

---

## Frontend integratie

### Belangrijk

Frontend uit zip = design reference

### Moet:

- omzetten naar Blade + Livewire  
- Tailwind integreren via Vite  
- data uit DB  

### Mag niet:

- HTML files laten staan  
- JS hacks behouden  
- mock data gebruiken  

---

## Testing

Gebruik Pest:

### Tests

- article CRUD  
- publish flow  
- search  
- policies  

---

## Fases

### Fase 1
- database  
- models  
- seeders  

### Fase 2
- homepage  
- listing  

### Fase 3
- artikel detail  

### Fase 4
- admin CMS  

### Fase 5
- search + filters  

### Fase 6
- testing  

---

## Anti-patronen

Weiger:

- alles in 1 component  
- business logic in Blade  
- mock data  
- slechte structuur  
- geen policies  

---

## Definitie van klaar

Een feature is klaar als:

- werkt met echte data  
- correct gestructureerd is  
- veilig is  
- performant is  
- testbaar is  

---

## Samenvattende hoofdregel

Bouw dit project als een **moderne Pinterest-achtige nieuwsapplicatie**, waarbij de frontend uit `test.zip` correct wordt vertaald naar een **schaalbare Laravel 13 + Livewire 4 CMS-architectuur**, zonder shortcuts, hacks of verouderde syntax.
