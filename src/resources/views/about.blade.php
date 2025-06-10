<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Tama Decorações') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    <div class="max-w-4xl mx-auto px-6 py-4 bg-white shadow-xl rounded-2xl space-y-10 leading-relaxed">
        <div class="flex items-center gap-6 border-b-2 border-black pb-4">
            <a href="{{ url()->previous() }}">
                <img src="{{ asset('img/fatec-logo.jpg') }}" alt="Logo Fatec Indaiatuba" class="h-14 object-contain" />
            </a>

            <a href="{{ route('welcome') }}">
                <img src="{{ asset('img/tamarossi-decoracoes-logo.png') }}" alt="Logo da empresa Tamarossi Decorações"
                    class="h-10 object-contain" />
            </a>
        </div>

        <!-- Seção GitHub: link + QR lado a lado -->
        <div class="flex flex-row justify-start items-center gap-6 pt-4">
            <img src="{{ asset('img/qr_tamadecor_github.png') }}" alt="QR Code do repositório GitHub"
                class="h-36 w-36 object-contain" />
            <div class="text-sm text-gray-500">
                Repositório do projeto disponível em:
                <br>
                <a href="https://github.com/TamaGab/tamadecor" target="_blank"
                    class="text-emerald-600 underline hover:text-emerald-800 transition">
                    https://github.com/TamaGab/tamadecor
                </a>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-emerald-800 flex items-center gap-3">
            <i class="fas fa-cubes-stacked text-emerald-600 text-2xl"></i>
            Projeto Acadêmico – 2º Semestre | Fatec Indaiatuba + Tama Decorações
        </h1>

        <div class="space-y-4">
            <div class="grid grid-cols-[24px_1fr] gap-3 items-start">
                <i class="fas fa-graduation-cap text-emerald-500 mt-1"></i>
                <p>
                    Este projeto foi desenvolvido durante o 2º semestre do curso de <span class="font-bold">Análise e
                        Desenvolvimento de Sistemas</span> na <span class="font-bold"> Fatec Indaiatuba</span>. A
                    proposta envolveu uma parceria entre
                    os integrantes do grupo
                    com a empresa <span class="font-bold">Tama Decorações</span>, especializada em soluções de
                    interiores como pisos, cortinas e box de vidro.
                </p>
            </div>

            <div class="grid grid-cols-[24px_1fr] gap-3 items-start">
                <i class="fas fa-briefcase text-emerald-500 mt-1"></i>
                <p>
                    O principal objetivo foi aplicar de forma prática os conhecimentos adquiridos em sala de aula,
                    dentro de um cenário com demandas reais do mercado profissional, simulando o ciclo completo de
                    desenvolvimento de software.
                </p>
            </div>
        </div>

        <div>
            <h2 class="text-lg font-bold text-emerald-700 flex items-center gap-2">
                <i class="fas fa-wrench text-emerald-500"></i>
                Funcionalidades desenvolvidas na aplicação WEB:
            </h2>
            <ul class="mt-4 text-base space-y-3">
                <li class="grid grid-cols-[24px_1fr] items-center gap-2">
                    <i class="fas fa-user text-emerald-500"></i>
                    <span>Operações CRUD <span class="font-bold">Clientes</span></span>
                </li>

                <li class="grid grid-cols-[24px_1fr] items-center gap-2">
                    <i class="fas fa-box text-emerald-500"></i>
                    <span>Operações CRUD <span class="font-bold">Produtos</span></span>
                </li>

                <li class="grid grid-cols-[24px_1fr] items-center gap-2">
                    <i class="fas fa-receipt text-emerald-500"></i>
                    <span>Operações CRUD <span class="font-bold">Pedidos</span></span>
                </li>

                <li class="grid grid-cols-[24px_1fr] items-center gap-2">
                    <i class="fas fa-chart-line text-emerald-500"></i>
                    <span><span class="font-bold">Dashboard</span> interativo e responsivo com gráficos e
                        indicadores</span>
                </li>

                <li class="grid grid-cols-[24px_1fr] items-center gap-2">
                    <i class="fas fa-lock text-emerald-500"></i>
                    <span>Implementação de <span class="font-bold">Autenticação de Usuários</span> com segurança e
                        controle de sessão</span>
                </li>
            </ul>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-[24px_1fr] gap-3 items-start">
                <i class="fas fa-comments text-emerald-500 mt-1"></i>
                <p>
                    As funcionalidades foram definidas com base em entrevistas realizadas com os representantes da
                    <span class="font-bold">Tama Decorações</span>, considerando suas principais necessidades
                    operacionais e desafios de gestão. A empresa utiliza atualmente ERPs genéricos que não atendem
                    totalmente às suas especificidades. Os módulos de cadastro de clientes, produtos e pedidos nesses
                    sistemas costumam ser desorganizados ou pouco intuitivos para a realidade da empresa.
                </p>
            </div>

            <div class="grid grid-cols-[24px_1fr] gap-3 items-start">
                <i class="fab fa-laravel text-emerald-500 mt-1"></i>
                <p>
                    O sistema foi construído utilizando o framework <span class="font-bold">Laravel</span>, um framework
                    PHP voltado para o desenvolvimento de aplicações web. Laravel segue o padrão <span
                        class="font-bold">MVC (Model-View-Controller)</span>,
                    padronizando a organização do código.
                    <br /><br />
                    No projeto, utilizou-se o
                    banco de dados <span class="font-bold">MySQL</span> e a ferramenta integrada no framework Laravel,
                    <span class="font-bold">Eloquent ORM</span> para
                    modelar e gerenciar o banco, reduzindo
                    a necessidade de escrever queries SQL diretamente.
                    <br /><br />
                    Ademais, a interface foi desenvolvida com <span class="font-bold">TailwindCSS</span> para
                    estilização, <span class="font-bold">Livewire</span> para componentes dinâmicos sem necessidade de
                    JavaScript manual, <span class="font-bold">TallStack UI</span> para elementos visuais modernos e
                    <span class="font-bold">Laravel Breeze</span> para autenticação e estrutura inicial. Outras
                    bibliotecas menores, com <span class="font-bold">funcionalidades especializadas</span> foram
                    utilizadas em conjunto.
                    <br /><br />
                </p>
            </div>

            <div class="grid grid-cols-[24px_1fr] gap-3 items-start">
                <i class="fas fa-vial text-emerald-500 mt-1"></i>
                <p>
                    <span class="font-bold">Por limitação de tempo</span>, não foram realizados testes com os usuários
                    da empresa. Contudo, todas as
                    funcionalidades foram pensadas com base nas entrevistas, priorizando clareza e simplicidade de uso.
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-xl font-bold text-emerald-700 flex items-center gap-2">
                <i class="fas fa-users text-emerald-500"></i>
                Equipe de Desenvolvimento
            </h2>
            <ul class="list-disc list-inside ml-6 text-base space-y-2">
                <li>Gabriel Tamarossi</li>
                <li>Gustavo Henrique Camargo Felizardo</li>
                <li>João Pedro Souza Silva</li>
                <li>Samuel José Santos Ribeiro da Silva</li>
            </ul>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-[24px_1fr] gap-3 items-start font-semibold">
                <i class="fas fa-clock text-emerald-500 mt-1"></i>
                <p>
                    Devido ao tempo limitado, algumas funcionalidades planejadas com base nas entrevistas
                    não puderam ser implementadas nesta versão da aplicação. Contudo, todas elas estão
                    documentadas para futuras iterações ou possíveis manutenções caso o projeto seja levado adiante
                    durante o curso.
                </p>
            </div>
        </div>

        <div
            class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-base text-emerald-700 shadow grid grid-cols-[24px_1fr] items-start gap-3">
            <i class="fas fa-handshake-angle mt-1 text-emerald-500"></i>
            <p>
                Agradecemos à equipe da <span class="font-bold">Tama Decorações</span> pela confiança, paciência e
                disponibilidade ao longo do projeto, bem como aos professores da <span class="font-bold">Fatec
                    Indaiatuba</span>, que nos orientaram e apoiaram durante todo o processo de desenvolvimento.
            </p>
        </div>



    </div>
</body>

</html>
