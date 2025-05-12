<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public $mobileMenuOpen = false;
    public $dropdownStates = [];

    public function mount()
    {
        // Inicializar estados de los menús desplegables
        $this->dropdownStates = [
            'menu1' => false,
            'menu2' => false,
            'menu3' => false,
            'menu4' => false,
            'menu5' => false,
            'menu6' => false,
            'menu7' => false,
            'menu8' => false,
            'menu9' => false,
            'menu10' => false,
            'menuAnidado' => false,
            'submenuAnidado' => false,
        ];
    }

    public function toggleMobileMenu()
    {
        $this->mobileMenuOpen = !$this->mobileMenuOpen;
    }

    public function toggleDropdown($menu)
    {
        $this->dropdownStates[$menu] = !$this->dropdownStates[$menu];
        $this->dispatch('dropdownToggled', $menu);
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

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
                    <!-- Menú 1 -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            Menú 1
                            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" 
                             @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" 
                             style="display: none;">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submenú 1.1</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submenú 1.2</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submenú 1.3</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menú 2 -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            Menú 2
                            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" 
                             style="display: none;">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submenú 2.1</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submenú 2.2</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menú 3 - Con submenú anidado -->
                    <div class="relative" x-data="{ open: false, subOpen: false }">
                        <button 
                            @click="open = !open" 
                            @keydown.escape="open = false"
                            class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
                            aria-expanded="false"
                            aria-label="Menú 3"
                        >
                            Menú 3
                            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div 
                            x-show="open" 
                            @click.away="open = false; subOpen = false" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" 
                            style="display: none;" 
                            role="menu"
                        >
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submenú 3.1</a>
                                
                                <!-- Elemento con submenú -->
                                <div class="relative" @mouseenter="subOpen = true" @mouseleave="subOpen = false">
                                    <button class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Submenú 3.2 ►
                                    </button>
                                    
                                    <div 
                                        x-show="subOpen" 
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 transform translate-x-2"
                                        x-transition:enter-end="opacity-100 transform translate-x-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 transform translate-x-0"
                                        x-transition:leave-end="opacity-0 transform translate-x-2"
                                        class="absolute left-full top-0 ml-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" 
                                        style="display: none;"
                                    >
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Nivel 2.1</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Nivel 2.2</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submenú 3.3</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menú 4 - Con Mega Menú -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            Mega Menú
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
                            class="absolute z-10 mt-2 w-screen max-w-md rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" 
                            style="display: none;">
                            <div class="grid grid-cols-2 gap-4 p-6">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Categoría 1</h3>
                                    <ul class="mt-2 space-y-2">
                                        <li><a href="#" class="text-sm text-gray-700 hover:text-gray-900">Opción 1.1</a></li>
                                        <li><a href="#" class="text-sm text-gray-700 hover:text-gray-900">Opción 1.2</a></li>
                                        <li><a href="#" class="text-sm text-gray-700 hover:text-gray-900">Opción 1.3</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Categoría 2</h3>
                                    <ul class="mt-2 space-y-2">
                                        <li><a href="#" class="text-sm text-gray-700 hover:text-gray-900">Opción 2.1</a></li>
                                        <li><a href="#" class="text-sm text-gray-700 hover:text-gray-900">Opción 2.2</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menú 5 (Simple) -->
                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                        Menú Simple
                    </a>

                    <!-- Menús 6-10 (puedes agregar más según se necesite) -->
                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                        Menú 6
                    </a>

                    <!-- Dashboard Link -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Tablero') }}
                    </x-nav-link>
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
            
            <!-- Menú 1 con submenús en móvil -->
            <div>
                <button 
                    wire:click="toggleDropdown('menu1')" 
                    class="w-full flex justify-between items-center px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out"
                >
                    <span>Menú 1</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        :class="{'rotate-180': $wire.dropdownStates.menu1}">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="$wire.dropdownStates.menu1" class="pl-4 bg-gray-50">
                    <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Submenú 1.1</a>
                    <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Submenú 1.2</a>
                    <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Submenú 1.3</a>
                </div>
            </div>
            
            <!-- Menú 2 con submenús en móvil -->
            <div>
                <button 
                    wire:click="toggleDropdown('menu2')" 
                    class="w-full flex justify-between items-center px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out"
                >
                    <span>Menú 2</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        :class="{'rotate-180': $wire.dropdownStates.menu2}">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="$wire.dropdownStates.menu2" class="pl-4 bg-gray-50">
                    <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Submenú 2.1</a>
                    <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Submenú 2.2</a>
                </div>
            </div>
            
            <!-- Menú con ítems anidados en móvil (Opción 6) -->
            <div>
                <button 
                    wire:click="toggleDropdown('menuAnidado')" 
                    class="w-full flex justify-between items-center px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out"
                >
                    <span>Menú Anidado</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        :class="{'rotate-180': $wire.dropdownStates.menuAnidado}">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="$wire.dropdownStates.menuAnidado" class="pl-4 bg-gray-50">
                    <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Nivel 1.1</a>
                    
                    <!-- Submenú anidado -->
                    <div>
                        <button 
                            wire:click="toggleDropdown('submenuAnidado')" 
                            class="w-full flex justify-between items-center py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100"
                        >
                            <span>Nivel 1.2 (Con subnivel)</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                :class="{'rotate-180': $wire.dropdownStates.submenuAnidado}">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div x-show="$wire.dropdownStates.submenuAnidado" class="pl-4 bg-gray-100">
                            <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-200">Nivel 2.1</a>
                            <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-200">Nivel 2.2</a>
                        </div>
                    </div>
                    
                    <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Nivel 1.3</a>
                </div>
            </div>
            
            <!-- Menú 4 - Mega Menú en móvil -->
            <div>
                <button 
                    wire:click="toggleDropdown('menu4')" 
                    class="w-full flex justify-between items-center px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out"
                >
                    <span>Mega Menú</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        :class="{'rotate-180': $wire.dropdownStates.menu4}">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="$wire.dropdownStates.menu4" class="pl-4 bg-gray-50">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 py-2 pl-4 pr-4">Categoría 1</h3>
                        <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Opción 1.1</a>
                        <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Opción 1.2</a>
                        <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Opción 1.3</a>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-sm font-medium text-gray-900 py-2 pl-4 pr-4">Categoría 2</h3>
                        <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Opción 2.1</a>
                        <a href="#" class="block py-2 pl-4 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100">Opción 2.2</a>
                    </div>
                </div>
            </div>
            
            <!-- Menú simple sin submenús en móvil -->
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out">
                Menú Simple
            </a>
            
      
            <!-- Dashboard Link en móvil -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Tablero') }}
            </x-responsive-nav-link>
                        
            <!-- Resto de menús para móvil... -->
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out">
                Menú 6
            </a>
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

<!-- Script para manejar el almacenamiento del estado del menú (Opción 8) -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cuando se abra un menú, guardar el estado
        if (typeof Livewire !== 'undefined') {
            Livewire.on('dropdownToggled', function(menuName) {
                try {
                    var data = {
                        state: true,
                        timestamp: new Date().getTime()
                    };
                    localStorage.setItem('menu_' + menuName, JSON.stringify(data));
                } catch (e) {
                    console.error('Error guardando estado del menú:', e);
                }
            });
        }
        
        // Al cargar la página, restaurar estados guardados (opcional)
        if (typeof Livewire !== 'undefined') {
            window.addEventListener('livewire:load', function() {
                try {
                    // Obtener todos los estados guardados
                    var keys = [];
                    var menuKeys = [];
                    
                    // Iterar sobre el localStorage
                    for (var i = 0; i < localStorage.length; i++) {
                        keys.push(localStorage.key(i));
                    }
                    
                    // Filtrar las claves que empiezan con 'menu_'
                    for (var j = 0; j < keys.length; j++) {
                        var key = keys[j];
                        if (key.indexOf('menu_') === 0) {
                            menuKeys.push(key);
                        }
                    }
                    
                    // Comprobar la edad de los estados guardados (1 hora de expiración)
                    var now = new Date().getTime();
                    var oneHour = 60 * 60 * 1000; // en milisegundos
                    
                    for (var k = 0; k < menuKeys.length; k++) {
                        var menuKey = menuKeys[k];
                        try {
                            var menuData = JSON.parse(localStorage.getItem(menuKey));
                            var menuNamePart = menuKey.substring(5); // elimina 'menu_'
                            
                            // Si el estado es reciente, restaurarlo
                            if (menuData && menuData.timestamp && (now - menuData.timestamp < oneHour)) {
                                // Opcional: restaurar el estado
                                // console.log('Restaurando estado para:', menuNamePart);
                            } else {
                                // Limpiar estados antiguos
                                localStorage.removeItem(menuKey);
                            }
                        } catch (e) {
                            console.error('Error restaurando estado del menú:', e);
                            localStorage.removeItem(menuKey);
                        }
                    }
                } catch (e) {
                    console.error('Error general en restauración de menús:', e);
                }
            });
        }
    });
</script>
@endpush