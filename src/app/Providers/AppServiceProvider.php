<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton("sidebarMenu", function () {
            return  [
                ['label' => 'Início', 'icon' => 'house', 'route' => 'dashboard'],
                [
                    'label' => 'Vendas',
                    'icon' => 'handshake',
                    'children' => [
                        ['label' => 'Clientes', 'route' => 'clients.index'],
                        ['label' => 'Produtos', 'route' => 'products.index'],
                        ['label' => 'Pedidos', 'route' => 'orders.index']
                    ]
                ],
                ['label' => 'Compras', 'icon' => 'cart-shopping', 'route' => 'dev'],
                [
                    'label' => 'Financeiro',
                    'icon' => 'money-bill',
                    'children' => [
                        ['label' => 'Fornecedores', 'route' => 'dev'],
                        ['label' => 'Recebimentos', 'route' => 'dev']
                    ]
                ],
                ['label' => 'Estoque', 'icon' => 'box-open', 'route' => 'dev'],
                ['label' => 'Relatórios', 'icon' => 'money-bill-trend-up', 'route' => 'dev'],
            ];
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('sidebarMenu', $this->app->make('sidebarMenu'));
    }
}
