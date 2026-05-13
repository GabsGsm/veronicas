<?php

namespace App\Enums;

enum ProductTag: string
{
    case Novo = 'Novo';
    case NovaColecao = 'Nova Coleção';
    case MaisVendido = 'Mais Vendido';
    case Lancamento = 'Lançamento';
    case Destaque = 'Destaque';
    case Premium = 'Premium';
    case Exclusivo = 'Exclusivo';
    case Tendencia = 'Tendência';
    case Promocao = 'Promoção';
    case Outlet = 'Outlet';

    public function label(): string
    {
        return $this->value;
    }
}
