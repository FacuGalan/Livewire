<div>
    <div class="flex items-center overflow-x-auto">
    @if($selectedMenu && count($subMenus) > 0)
    <a href="{{ route('departamentos') }}" wire:navigate>Departamentos Directo</a>
                @foreach($subMenus as $subMenu)
                    <a 
                        @if(Route::has($subMenu->modulo))
                            href="{{ route($subMenu->modulo) }}" 
                        @else 
                            href="#" 
                        @endif
                        wire:navigate
                        class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out no-underline whitespace-nowrap"
                        title="{{ $subMenu->detalle }}"
                    >
                        @if($subMenu->recurso)
                            <i class="{{ $subMenu->recurso }} mr-1 text-indigo-500"></i>
                        @else
                            <i class="fas fa-link mr-1 text-indigo-500"></i>
                        @endif
                        <span>{{ $subMenu->etiqueta }}</span>
                    </a>
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
        <a href="{{ route('departamentos') }}" wire:navigate>Departamentos Directo</a>
    @endif
    </div>
</div>