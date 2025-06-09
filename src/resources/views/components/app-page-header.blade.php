 <header class="bg-white shadow-lg border-gray-200 h-16 flex items-center px-3">
     <a href="{{ route('dashboard') }}">
         <img src="{{ asset('img/tamarossi-decoracoes-logo.png') }}" alt="Logo da empresa Tamarossi Decorações">
     </a>
     <div class="max-w-7xl mx-auto">
         <h1 class="text-2xl pl-10 font-bold text-black">
             @yield('title')
         </h1>
     </div>

     <div class="pr-10 relative">
         <button type="button"
             class="flex items-center gap-3 p-3 rounded transition-all duration-200 text-black hover:text-emerald-300"
             data-dropdown-toggle="logoutMenu" aria-controls="logoutMenu" aria-expanded="false">
             <i class="fa-solid fa-user"></i>
             {{ Auth::user()->name }}
             <i class="fa-solid fa-chevron-down ml-auto text-xs transition-transform duration-200"></i>
         </button>

         <ul id="logoutMenu" class="hidden w-36 bg-white rounded shadow-lg z-10 py-3 pl-5 space-y-2">
             <li>
                 <a href="{{ route('profile.edit') }} ">
                     @csrf
                     <button type="submit" class="text-sm text-black hover:text-emerald-300 rounded">
                         Perfil
                     </button>
                 </a>
             </li>
             <li>
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf
                     <button type="submit" class="text-sm text-black hover:text-emerald-300 rounded">
                         Sair
                     </button>
                 </form>
             </li>



         </ul>
     </div>
 </header>
