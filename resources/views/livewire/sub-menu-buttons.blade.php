<div>
    <div class="flex items-center overflow-x-auto">
    @if($selectedMenu && count($subMenus) > 0)
        @foreach($subMenus as $subMenu)
            @if(Route::has($subMenu->modulo))
                <a 
                    href="{{ route($subMenu->modulo, ['menu' => $selectedMenu, 'submenu' => $subMenu->codigo]) }}" 
                    wire:navigate
                    class="px-3 py-2 text-sm font-medium {{ $activeSubMenu == $subMenu->codigo ? 'text-indigo-600 border-b-2 border-indigo-400' : 'text-gray-500 hover:text-gray-700' }} focus:outline-none transition duration-150 ease-in-out no-underline whitespace-nowrap"
                    title="{{ $subMenu->detalle }}"
                >
                    @if($subMenu->recurso)
                        <i class="{{ $subMenu->recurso }} mr-1 text-indigo-500"></i>
                    @else
                        <i class="fas fa-link mr-1 text-indigo-500"></i>
                    @endif
                    <span>{{ $subMenu->etiqueta }}</span>
                </a>
            @else 
                <a 
                    href="javascript:void(0);" 
                    wire:click.prevent="selectSubMenu('{{ $subMenu->codigo }}')"
                    class="px-3 py-2 text-sm font-medium {{ $activeSubMenu == $subMenu->codigo ? 'text-indigo-600 border-b-2 border-indigo-400' : 'text-gray-500 hover:text-gray-700' }} focus:outline-none transition duration-150 ease-in-out no-underline whitespace-nowrap"
                    title="{{ $subMenu->detalle }}"
                >
                    @if($subMenu->recurso)
                        <i class="{{ $subMenu->recurso }} mr-1 text-indigo-500"></i>
                    @else
                        <i class="fas fa-link mr-1 text-indigo-500"></i>
                    @endif
                    <span>{{ $subMenu->etiqueta }}</span>
                </a>
            @endif
        @endforeach
    @else
        <a 
        href="#" 
        class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out no-underline whitespace-nowrap"
        title="Acerca"
        >
        <span>Acerca</span>
        </a>
        <a 
        href="#" 
        class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out no-underline whitespace-nowrap"
        title="Mi cuenta"
        >
        <span>Mi cuenta</span>
        </a>
        <a 
        href="#" 
        class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out no-underline whitespace-nowrap"
        title="Novedades"
        >
        <span>Novedades</span>
        </a>

    @endif
    </div>
</div>