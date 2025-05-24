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
                ['label' => 'Vendas', 'icon' => 'handshake', 'route' => 'clients.create'],
                [
                    'label' => 'Compras',
                    'icon' => 'cart-shopping',
                    'children' => [
                        ['label' => 'Fornecedores', 'route' => 'welcome'],
                        ['label' => 'Fornecedores', 'route' => 'welcome']
                    ]
                ],
                [
                    'label' => 'Financeiro',
                    'icon' => 'money-bill',
                    'children' => [
                        ['label' => 'Fornecedores', 'route' => 'welcome'],
                        ['label' => 'Fornecedores', 'route' => 'welcome']
                    ]
                ],
                ['label' => 'Estoque', 'icon' => 'box-open', 'route' => 'welcome'],
                ['label' => 'Relatórios', 'icon' => 'money-bill-trend-up', 'route' => 'welcome'],
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
