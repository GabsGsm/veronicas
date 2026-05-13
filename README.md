# Verônica's Fashion — Catálogo Premium

Catálogo digital fiel ao protótipo React `Digital Fashion Catalog Interface`,
migrado para **Laravel 13 + Livewire 4 + TailwindCSS 4 + Alpine.js**.

> Boutique feminina premium — paleta rosé/nude/off-white, tipografia editorial
> (Playfair Display + Great Vibes + Inter), animações suaves e arquitetura
> escalável pensada para integração futura com backend real.

---

## ✨ O que está implementado

### Páginas (Livewire)

| Rota | Componente | Função |
|------|------------|--------|
| `/` | `Pages\Home` | Hero carousel + Destaques + Nova Coleção + Promoções |
| `/destaques` | `Pages\Catalog` (mode=featured) | Produtos em destaque |
| `/nova-colecao` | `Pages\Catalog` (mode=new) | Lançamentos da coleção atual |
| `/promocoes` | `Pages\Catalog` (mode=sale) | Itens com preço promocional |
| `/categoria/{slug}` | `Pages\Catalog` (mode=category) | Vestidos, Conjuntos, Casual, Acessórios |
| `/ocasiao/{occasion}` | `Pages\Catalog` (mode=occasion) | Festa, Trabalho, Casual, Especial |
| `/produto/{slug}` | `Pages\ProductDetail` | Galeria + selectors + WhatsApp CTA + relacionados |
| `/colecao/{slug}` | `Pages\CollectionShow` | Hero + grid editorial + storytelling |
| `/favoritos` | `Pages\Favorites` | Lista de desejos (sessão) |
| `/contato` | `Pages\Contact` | Instagram + WhatsApp QR + boutique info |

### Componentes Blade reutilizáveis

`product-card`, `product-grid`, `page-header`, `section-title`, `hero-carousel`,
`product-gallery`, `size-selector`, `color-selector`, `whatsapp-cta`,
`collection-hero`, `editorial-banner`, `icon` (22 ícones Lucide inlined).

### Componentes Livewire compartilhados

`Shared\Sidebar` — menu fixo desktop
`Shared\MobileHeader` — drawer mobile
`Shared\FilterPanel` — painel deslizante de filtros

### Models

`Category`, `Collection`, `Banner`, `Product` — com relacionamentos, casts e
accessors (`formatted_price`, `formatted_original_price`, `images`).

### Dados mockados

16 produtos premium, 3 coleções editoriais (Dia das Mães, Primavera, Tendências 2026),
3 banners cinematográficos, 4 categorias. Tudo fiel ao mock React.

---

## 🛠 Stack

- **Laravel 13.7**
- **Livewire 4** (com Alpine.js incluído)
- **TailwindCSS 4** (via `@tailwindcss/vite`)
- **PHP 8.3+**
- **SQLite** (dev) — pronto para MySQL/Postgres em produção
- Fontes: Inter, Playfair Display, Great Vibes (Bunny CDN)

---

## 🚀 Instalação

```bash
# 1. Dependências
composer install
npm install

# 2. Ambiente
cp .env.example .env
php artisan key:generate

# 3. Banco de dados (SQLite)
touch database/database.sqlite
php artisan migrate --seed

# 4. Frontend assets
npm run build      # produção
# ou
npm run dev        # desenvolvimento (HMR)

# 5. Servidor de desenvolvimento (em outro terminal)
php artisan serve
```

Acesse: <http://localhost:8000>

### Atalho composer

```bash
composer setup
```

### Modo dev (server + queue + vite em paralelo)

```bash
composer dev
```

---

## ⚙️ Configuração da boutique

Edite `config/veronica.php` ou via `.env`:

```env
VERONICA_WHATSAPP_NUMBER=5511987654321
VERONICA_INSTAGRAM=veronicasfashion
VERONICA_PHONE_DISPLAY="(11) 98765-4321"
```

---

## 📂 Arquitetura

```
app/
├── Livewire/
│   ├── Concerns/
│   │   └── ManagesFavorites.php       # trait de favoritos (sessão)
│   ├── Pages/
│   │   ├── Home.php
│   │   ├── Catalog.php                # unifica destaques/nova/sale/category/occasion
│   │   ├── ProductDetail.php
│   │   ├── CollectionShow.php
│   │   ├── Favorites.php
│   │   └── Contact.php
│   └── Shared/
│       ├── Sidebar.php
│       ├── MobileHeader.php
│       └── FilterPanel.php
├── Models/
│   ├── Category.php
│   ├── Collection.php
│   ├── Product.php
│   └── Banner.php
└── Providers/
    └── AppServiceProvider.php

resources/
├── css/app.css                        # paleta, fontes, animações
├── js/app.js
└── views/
    ├── components/                    # 14 Blade components reutilizáveis
    │   ├── layouts/app.blade.php
    │   ├── product-card.blade.php
    │   ├── hero-carousel.blade.php
    │   └── …
    └── livewire/
        ├── pages/                     # views dos componentes de página
        └── shared/                    # views dos compartilhados

database/
├── migrations/                        # categories, collections, products, banners
├── factories/
└── seeders/
    ├── DatabaseSeeder.php
    ├── CategorySeeder.php
    ├── CollectionSeeder.php
    ├── BannerSeeder.php
    └── ProductSeeder.php               # 16 produtos do mock React

config/veronica.php                    # config da boutique (WhatsApp, social, contato)
routes/web.php                         # 10 rotas nomeadas
```

---

## 🎨 Design System

### Cores (CSS vars em `app.css`)

| Token | Hex |
|-------|-----|
| `--color-primary` (Rosé 500) | `#e89b9b` |
| `--color-nude` | `#f5e8e4` |
| `--color-off-white` | `#faf9f7` |
| `--color-warm-white` (background) | `#fffcf9` |
| `--color-gold-accent` | `#d4af37` |

### Tipografia

- **Títulos**: `font-serif` → Playfair Display
- **Decorativo**: `font-script` → Great Vibes
- **Corpo**: `font-sans` → Inter

### Utilitários customizados

`bg-editorial-rose`, `bg-editorial-cream`, `shadow-premium`, `shadow-premium-hover`,
`animate-fade-in-up`, `animate-slide-in-right`, `scrollbar-thin`,
`line-clamp-1`, `line-clamp-2`.

---

## 🔮 Preparado para o futuro

A arquitetura já está pronta para:

- **Backend real**: models, relacionamentos e migrations existem
- **Variações por SKU**: basta migrar `sizes`/`colors` de JSON para tabela `product_variations`
- **Múltiplas imagens**: tabela `product_images` já é o passo natural (hoje é `gallery: json`)
- **Carrinho**: trocar `ManagesFavorites` por `ManagesCart` no mesmo modelo
- **Multi-idioma**: substituir strings literais por chaves `__()`
- **Admin**: adicionar Filament ou Nova sobre os models existentes

---

## 📱 Responsividade

- **Mobile**: 1 coluna, drawer lateral, header fixo top
- **SM (640px+)**: 2 colunas no grid
- **LG (1024px+)**: 3 colunas + sidebar fixa
- **XL (1280px+)**: 4 colunas

---

## 🧪 Testes

```bash
php artisan test
```

Estrutura Pest pronta — testes específicos da Verônica's a desenvolver
conforme o projeto evolui.

---

**© 2026 Verônica's Fashion** — Boutique Premium Feminina
*Elegância que inspira*
