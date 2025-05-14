<nav x-data="{ open: false, selectedMenuCode: '{{ $selectedMenu }}' }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu (Desktop) -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div wire:ignore class="hidden space-x-2 sm:flex sm:items-center sm:ml-6">
                    
                    
                    <!-- Menús principales (sin submenús desplegables) -->
                    @foreach ($menuItems as $item)
                        <a 
                            href="{{ request()->url() }}?menu={{ $item->codigo }}" 
                            wire:click.prevent="selectMenu('{{ $item->codigo }}')"
                            class="menu-item px-3 py-2 text-sm font-medium border-b-2 focus:outline-none transition duration-150 ease-in-out {{ $selectedMenu === $item->codigo ? 'text-indigo-600 border-indigo-400' : 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300' }}"
                            title="{{ $item->detalle }}"
                        >
                            @if ($item->recurso)
                                <i class="{{ $item->recurso }} mr-1"></i>
                            @endif
                            {{ $item->etiqueta }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu Button (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button 
                    @click="$wire.toggleMobileMenu()" 
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    aria-expanded="false"
                    aria-label="Toggle navigation menu"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': $wire.mobileMenuOpen, 'inline-flex': !$wire.mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !$wire.mobileMenuOpen, 'inline-flex': $wire.mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div 
        :class="{'block': $wire.mobileMenuOpen, 'hidden': !$wire.mobileMenuOpen}" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2"
        class="hidden sm:hidden"
    >
        <div class="pt-2 pb-3 space-y-1">
            <!-- Mobile Menu Items -->
            <div wire:ignore>
                @foreach ($menuItems as $item)
                    <a 
                        href="#{{ $item->codigo }}" 
                        wire:click.prevent="selectMenu('{{ $item->codigo }}')"
                        @click="selectedMenuCode = '{{ $item->codigo }}'"
                        class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium focus:outline-none transition duration-150 ease-in-out"
                        :class="selectedMenuCode === '{{ $item->codigo }}' ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300'"
                        title="{{ $item->detalle }}"
                    >
                        @if ($item->recurso)
                            <i class="{{ $item->recurso }} mr-1"></i>
                        @endif
                        {{ $item->etiqueta }}
                    </a>
                @endforeach
            </div>
            
            <!-- Dashboard Link en móvil -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') && !$selectedMenu" wire:navigate>
                {{ __('Tablero') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('livewire:initialized', function () {
        Livewire.on('urlUpdate', function (params) {
            // Actualizamos la URL sin recargar la página usando History API
            if (params.url) {
                window.history.pushState({}, '', params.url);
            }
        });
        
        // Capturar los clics en enlaces con wire:navigate para preservar el estado
        document.addEventListener('click', function(e) {
            let target = e.target;
            
            // Buscar el elemento <a> si el clic fue en un hijo
            while (target && target.tagName !== 'A') {
                target = target.parentElement;
            }
            
            // Si es un enlace con wire:navigate, preservar los parámetros de menú
            if (target && target.hasAttribute('wire:navigate')) {
                const url = new URL(target.href);
                const currentUrl = new URL(window.location.href);
                
                // Conservar los parámetros de menú si no están ya en la URL destino
                if (!url.searchParams.has('menu') && currentUrl.searchParams.has('menu')) {
                    url.searchParams.set('menu', currentUrl.searchParams.get('menu'));
                }
                
                if (!url.searchParams.has('submenu') && currentUrl.searchParams.has('submenu')) {
                    url.searchParams.set('submenu', currentUrl.searchParams.get('submenu'));
                }
                
                // Actualizar el href con los parámetros preservados
                target.href = url.toString();
            }
        }, true);
    });
    // Escuchar eventos de Livewire
    document.addEventListener('livewire:initialized', function() {
        Livewire.on('menuSelected', function(menuCode) {
            // Actualizar la variable Alpine.js en todos los componentes
            document.querySelectorAll('[x-data]').forEach(function(el) {
                if (el.__x && typeof el.__x.getUnobservedData === 'function') {
                    const data = el.__x.getUnobservedData();
                    if ('selectedMenuCode' in data) {
                        el.__x.updateData('selectedMenuCode', menuCode);
                    }
                }
            });
        });
    });
</script>