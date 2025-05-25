<aside class="top-0 left-0 w-80 h-full bg-emerald-600 text-white">
    <nav class="px-5 py-5 space-y-1 text-sm font-medium">
        @foreach ($sidebarMenu as $item)
            @php
                $isActive = isset($item['route']) && request()->routeIs($item['route']);
                $hasChildren = isset($item['children']);
                $collapseId = Str::slug($item['label']) . '-submenu';
                $hasActiveChild =
                    $hasChildren &&
                    collect($item['children'])->pluck('route')->contains(fn($route) => request()->routeIs($route));
            @endphp

            @if (!$hasChildren)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 p-3 rounded transition-all duration-200
                          hover:text-emerald-300 {{ $isActive ? 'text-emerald-300 font-bold' : '' }}">

                    <span class="w-6 flex justify-center">
                        <i
                            class="fa-solid fa-{{ $item['icon'] }} leading-none transition-all duration-200 {{ $isActive ? 'text-2xl' : 'text-lg' }}"></i>
                    </span>

                    <span class="leading-tight transition-all duration-200 {{ $isActive ? 'text-2xl' : 'text-lg' }}">
                        {{ $item['label'] }}
                    </span>
                </a>
            @else
                <button type="button"
                    class="flex items-center w-full gap-3 p-3 rounded transition-all duration-200
                           hover:text-emerald-300
                           {{ $hasActiveChild ? 'text-emerald-300 font-bold text-2xl' : 'text-lg' }}"
                    data-collapse-toggle="{{ $collapseId }}" aria-controls="{{ $collapseId }}"
                    aria-expanded="{{ $hasActiveChild ? 'true' : 'false' }}">
                    <span class="w-6 flex justify-center">
                        <i
                            class="fa-solid fa-{{ $item['icon'] }} transition-all duration-200 {{ $hasActiveChild ? 'text-xl' : 'text-lg' }}"></i>
                    </span>
                    <span class="flex-1 text-left">{{ $item['label'] }}</span>
                    <i class="fa-solid fa-chevron-down ml-auto text-sm transition-transform duration-200"></i>
                </button>

                <ul id="{{ $collapseId }}" class="py-1 pl-10 {{ $hasActiveChild ? '' : 'hidden' }}">
                    @foreach ($item['children'] as $child)
                        @php
                            $childActive = request()->routeIs($child['route']);
                        @endphp
                        <li>
                            <a href="{{ route($child['route']) }}"
                                class="block p-2 rounded hover:text-emerald-300 transition
                                       {{ $childActive ? 'text-emerald-300 font-bold' : '' }}">
                                {{ $child['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </nav>
</aside>
