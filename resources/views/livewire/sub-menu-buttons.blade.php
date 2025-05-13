<div>
    @if($selectedMenu && count($subMenus) > 0)

            <div class="flex items-center overflow-x-auto">
                @foreach($subMenus as $subMenu)
                    <a 
                        href="#{{ $subMenu->codigo }}" 
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
            </div>
    @else
        <h2>Inicio</h2>
    @endif
</div>