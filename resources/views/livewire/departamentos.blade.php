<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Gestión de Departamentos</h2>
                    <button wire:click="createDepto" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-1"></i> Nuevo Departamento
                    </button>
                </div>

                <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0">
                        <label for="search" class="sr-only">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input wire:model.live.debounce.300ms="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar departamentos..." type="search">
                        </div>
                    </div>
                    <div class="w-full sm:w-auto flex items-center space-x-2">
                        <label for="perPage" class="text-sm text-gray-600">Mostrar:</label>
                        <select wire:model.live="perPage" id="perPage" class="border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('codigo')">
                                    <div class="flex items-center">
                                        Código
                                        @if($sortField === 'codigo')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                        @else
                                            <i class="fas fa-sort ml-1"></i>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nombre')">
                                    <div class="flex items-center">
                                        Nombre
                                        @if($sortField === 'nombre')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                        @else
                                            <i class="fas fa-sort ml-1"></i>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('resumido')">
                                    <div class="flex items-center">
                                        Resumido
                                        @if($sortField === 'resumido')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                        @else
                                            <i class="fas fa-sort ml-1"></i>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('orden')">
                                    <div class="flex items-center">
                                        Orden
                                        @if($sortField === 'orden')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                        @else
                                            <i class="fas fa-sort ml-1"></i>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('visible')">
                                    <div class="flex items-center">
                                        Visible
                                        @if($sortField === 'visible')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                        @else
                                            <i class="fas fa-sort ml-1"></i>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($deptos as $depto)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $depto->codigo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $depto->nombre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $depto->resumido }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $depto->orden }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($depto->visible)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i> Sí
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                <i class="fas fa-times mr-1"></i> No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="editDepto({{ $depto->codigo }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button wire:click="confirmDelete({{ $depto->codigo }})" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No se encontraron departamentos
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $deptos->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear/editar departamento -->
    @if($showModalForm)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <form wire:submit="saveDepto">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        {{ $isEditing ? 'Editar Departamento' : 'Crear Nuevo Departamento' }}
                                    </h3>
                                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Nombre -->
                                        <div>
                                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                            <input type="text" wire:model="depto.nombre" id="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('depto.nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Resumido -->
                                        <div>
                                            <label for="resumido" class="block text-sm font-medium text-gray-700">Nombre Resumido</label>
                                            <input type="text" wire:model="depto.resumido" id="resumido" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('depto.resumido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- IVA -->
                                        <div>
                                            <label for="iva" class="block text-sm font-medium text-gray-700">IVA</label>
                                            <input type="number" wire:model="depto.iva" id="iva" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('depto.iva') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Icono -->
                                        <div>
                                            <label for="icono" class="block text-sm font-medium text-gray-700">Icono</label>
                                            <input type="text" wire:model="depto.icono" id="icono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('depto.icono') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Orden -->
                                        <div>
                                            <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                                            <input type="number" wire:model="depto.orden" id="orden" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('depto.orden') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Descuento -->
                                        <div>
                                            <label for="descuento" class="block text-sm font-medium text-gray-700">Descuento (%)</label>
                                            <input type="number" step="0.01" wire:model="depto.descuento" id="descuento" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('depto.descuento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Opciones booleanas - Primera columna -->
                                        <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-200 pt-4 mt-4">
                                            <div>
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.visible" id="visible" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="visible" class="ml-3 block text-sm font-medium text-gray-700">Visible</label>
                                                </div>

                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lMesas" id="lMesas" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lMesas" class="ml-3 block text-sm font-medium text-gray-700">Mesas</label>
                                                </div>

                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lMostrador" id="lMostrador" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lMostrador" class="ml-3 block text-sm font-medium text-gray-700">Mostrador</label>
                                                </div>
                                                
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lPOS" id="lPOS" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lPOS" class="ml-3 block text-sm font-medium text-gray-700">POS</label>
                                                </div>
                                            </div>

                                            <!-- Opciones booleanas - Segunda columna -->
                                            <div>
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lDelivery" id="lDelivery" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lDelivery" class="ml-3 block text-sm font-medium text-gray-700">Delivery</label>
                                                </div>

                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lWeb" id="lWeb" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lWeb" class="ml-3 block text-sm font-medium text-gray-700">Web</label>
                                                </div>

                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lCarDig" id="lCarDig" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lCarDig" class="ml-3 block text-sm font-medium text-gray-700">Carta Digital</label>
                                                </div>
                                                
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lVendido" id="lVendido" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lVendido" class="ml-3 block text-sm font-medium text-gray-700">Vendido</label>
                                                </div>
                                            </div>

                                            <!-- Opciones booleanas - Tercera columna -->
                                            <div>
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lPromo" id="lPromo" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lPromo" class="ml-3 block text-sm font-medium text-gray-700">Promoción</label>
                                                </div>
                                                
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lNuevo" id="lNuevo" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lNuevo" class="ml-3 block text-sm font-medium text-gray-700">Nuevo</label>
                                                </div>

                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lVegetariano" id="lVegetariano" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lVegetariano" class="ml-3 block text-sm font-medium text-gray-700">Vegetariano</label>
                                                </div>
                                                
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lTacc" id="lTacc" class<div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lTacc" id="lTacc" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lTacc" class="ml-3 block text-sm font-medium text-gray-700">Sin TACC</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Opciones avanzadas - Mostrar/Ocultar -->
                                        <div class="col-span-1 md:col-span-2 mt-4">
                                            <button type="button" x-data="{}" x-on:click="$dispatch('toggle-advanced-options')" class="text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none">
                                                <i class="fas fa-cog mr-1"></i> Opciones avanzadas
                                            </button>
                                        </div>

                                        <!-- Opciones avanzadas - Contenido -->
                                        <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-200 pt-4 mt-2" 
                                             x-data="{ show: false }" 
                                             x-on:toggle-advanced-options.window="show = !show"
                                             x-show="show"
                                             x-transition:enter="transition ease-out duration-300"
                                             x-transition:enter-start="opacity-0 transform scale-95"
                                             x-transition:enter-end="opacity-100 transform scale-100"
                                             x-transition:leave="transition ease-in duration-200"
                                             x-transition:leave-start="opacity-100 transform scale-100"
                                             x-transition:leave-end="opacity-0 transform scale-95">
                                            <!-- Primera columna de opciones avanzadas -->
                                            <div>
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lVegano" id="lVegano" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lVegano" class="ml-3 block text-sm font-medium text-gray-700">Vegano</label>
                                                </div>
                                                
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lLactosa" id="lLactosa" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lLactosa" class="ml-3 block text-sm font-medium text-gray-700">Sin Lactosa</label>
                                                </div>
                                            </div>

                                            <!-- Segunda columna de opciones avanzadas -->
                                            <div>
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lKosher" id="lKosher" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lKosher" class="ml-3 block text-sm font-medium text-gray-700">Kosher</label>
                                                </div>
                                                
                                                <div class="flex items-center h-5 mb-4">
                                                    <input type="checkbox" wire:model="depto.lFrutos" id="lFrutos" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    <label for="lFrutos" class="ml-3 block text-sm font-medium text-gray-700">Sin Frutos Secos</label>
                                                </div>
                                            </div>

                                            <!-- Tercera columna de opciones avanzadas -->
                                            <div>
                                                <label for="cantidad_iconos" class="block text-sm font-medium text-gray-700">Cantidad de Iconos</label>
                                                <input type="number" wire:model="depto.cantidad_iconos" id="cantidad_iconos" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                @error('depto.cantidad_iconos') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ $isEditing ? 'Actualizar' : 'Crear' }}
                            </button>
                            <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de confirmación para eliminar -->
    @if($confirmingDeletion)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Confirmar eliminación
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        ¿Estás seguro que deseas eliminar este departamento? Esta acción no se puede deshacer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" wire:click="deleteDepto" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Eliminar
                        </button>
                        <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Sistema de notificaciones -->
    <div 
        x-data="{ 
            show: false,
            type: '',
            message: '',
            showNotification(data) {
                this.show = true;
                this.type = data.type;
                this.message = data.message;
                setTimeout(() => { this.show = false }, 3000);
            }
        }"
        x-on:notify.window="showNotification($event.detail)"
        x-show="show"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50"
    >
        <div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div x-show="type === 'success'">
                            <i class="fas fa-check-circle text-green-500 text-lg"></i>
                        </div>
                        <div x-show="type === 'error'">
                            <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p x-text="message" class="text-sm font-medium text-gray-900"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="show = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Cerrar</span>
                            <i class="fas fa-times text-gray-500"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>