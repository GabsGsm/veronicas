<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class Sidebar extends Component
{
    /**
     * Menu fixo do React. Cada item resolve para uma rota (ou usa um menu_id virtual
     * que carrega CategoryPage com filtros).
     *
     * @var array<int, array{label: string, icon: string, route: string, params?: array<string, string>}>
     */
    public array $menuItems = [
        ['label' => 'Início',        'icon' => 'home',          'route' => 'home'],
        ['label' => 'Destaques',     'icon' => 'sparkles',      'route' => 'catalog.featured'],
        ['label' => 'Nova Coleção',  'icon' => 'shopping-bag',  'route' => 'catalog.new'],
        ['label' => 'Vestidos',      'icon' => 'shirt',         'route' => 'catalog.category', 'params' => ['category' => 'vestidos']],
        ['label' => 'Conjuntos',     'icon' => 'package',       'route' => 'catalog.category', 'params' => ['category' => 'conjuntos']],
        ['label' => 'Casual',        'icon' => 'coffee',        'route' => 'catalog.category', 'params' => ['category' => 'casual']],
        ['label' => 'Festa',         'icon' => 'party-popper',  'route' => 'catalog.occasion', 'params' => ['occasion' => 'Festa']],
        ['label' => 'Acessórios',    'icon' => 'watch',         'route' => 'catalog.category', 'params' => ['category' => 'acessorios']],
        ['label' => 'Promoções',     'icon' => 'tag',           'route' => 'catalog.sale'],
        ['label' => 'Favoritos',     'icon' => 'heart',         'route' => 'favorites'],
        ['label' => 'Contato',       'icon' => 'mail',          'route' => 'contact'],
    ];

    public function render()
    {
        return view('livewire.shared.sidebar');
    }
}
