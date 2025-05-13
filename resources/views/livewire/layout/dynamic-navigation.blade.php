

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu (Desktop) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" wire:navigate>
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>

                    <!-- Navigation Links (Desktop) -->
                    <div class="hidden space-x-2 sm:flex sm:items-center sm:ml-6">
                        <!-- Dashboard Link -->
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                            {{ __('Inicio') }}
                        </x-nav-link>
                        <!-- Menús dinámicos -->
                        @foreach ($menuItems as $item)
                            @if ($item->hasChildren())
                                <div class="relative" x-data="{ open: false }">
                                    <button 
                                        @click="open = !open" 
                                        class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
                                        aria-expanded="false"
                                        aria-label="{{ $item->etiqueta }}"
                                    >
                                        @if ($item->recurso)
                                            <i class="{{ $item->recurso }} mr-1"></i>
                                        @endif
                                        {{ $item->etiqueta }}
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <div 
                                        x-show="open" 
                                        @click.away="open = false" 
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 transform scale-95"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-95"
                                        class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" 
                                        style="display: none;"
                                    >
                                        <div class="py-1">
                                            @foreach ($item->children as $child)
                                                <a 
                                                    href="#{{ $child->codigo }}" 
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    title="{{ $child->detalle }}"
                                                >
                                                    @if ($child->recurso)
                                                        <i class="{{ $child->recurso }} mr-1"></i>
                                                    @endif
                                                    {{ $child->etiqueta }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Menú simple sin submenús -->
                                <a 
                                    href="#{{ $item->codigo }}" 
                                    class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
                                    title="{{ $item->detalle }}"
                                >
                                    @if ($item->recurso)
                                        <i class="{{ $item->recurso }} mr-1"></i>
                                    @endif
                                    {{ $item->etiqueta }}
                                </a>
                            @endif
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
                @foreach ($menuItems as $item)
                    @if ($item->hasChildren())
                        <div>
                            <button 
                                wire:click="toggleDropdown('{{ $item->codigo }}')" 
                                class="w-full flex justify-between items-center px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out"
                            >
                                <span>
                                    @if ($item->recurso)
                                        <i class="{{ $item->recurso }} mr-1"></i>
                                    @endif
                                    {{ $item->etiqueta }}
                                </span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    :class="{'rotate-180': $wire.dropdownStates['{{ $item->codigo }}']}">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <div x-show="$wire.dropdownStates['{{ $item->codigo }}']" class="pl-4 bg-gray-50">
                                @foreach ($item->children as $child)
                                    <a 
                                        href="#{{ $child->codigo }}" 
                                        class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100"
                                        title="{{ $child->detalle }}"
                                    >
                                        @if ($child->recurso)
                                            <i class="{{ $child->recurso }} mr-1"></i>
                                        @endif
                                        {{ $child->etiqueta }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a 
                            href="#{{ $item->codigo }}" 
                            class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out"
                            title="{{ $item->detalle }}"
                        >
                            @if ($item->recurso)
                                <i class="{{ $item->recurso }} mr-1"></i>
                            @endif
                            {{ $item->etiqueta }}
                        </a>
                    @endif
                @endforeach
                
                <!-- Dashboard Link en móvil -->
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
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
