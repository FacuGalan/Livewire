<?php

namespace App\Livewire;

use App\Models\Depto;
use App\Models\Iva; 
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Departamentos extends Component
{
    use WithPagination;

    // Estados para la gestión de departamentos
    public $showModalForm = false;
    public $isEditing = false;
    public $confirmingDeletion = false;
    public $search = '';
    public $sortField = 'codigo';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    // Datos del formulario
     public $depto = [
        'codigo' => null,
        'nombre' => '',
        'resumido' => '',
        'iva' => null,
        'icono' => '',
        'orden' => 0,
        'visible' => true,
        'lMesas' => true,
        'lMostrador' => true,
        'lPOS' => true,
        'lDelivery' => true,
        'lWeb' => true,
        'lCarDig' => true,
        'descuento' => 0.00,
        'lVendido' => false,
        'lPromo' => false,
        'lNuevo' => false,
        'lVegetariano' => false,
        'lTacc' => false,
        'lVegano' => false,
        'lLactosa' => false,
        'lKosher' => false,
        'lFrutos' => false,
        'cantidad_iconos' => 0,
    ];

    // Propiedades nuevas para la búsqueda de IVA
    public $searchIva = '';
    public $ivas = [];
    public $showIvaDropdown = false;
    public $selectedIvaName = '';
    
    public $deptoIdToDelete;

    protected $listeners = ['refreshDepartamentos' => '$refresh'];

    // Reglas de validación
    protected function rules()
    {
        $codigoRule = $this->isEditing 
            ? ['nullable', Rule::unique('deptos', 'codigo')->ignore($this->depto['codigo'], 'codigo')] 
            : ['nullable', 'unique:deptos,codigo'];
            
        return [
            'depto.nombre' => 'required|string|max:30',
            'depto.resumido' => 'nullable|string|max:12',
            'depto.iva' => 'nullable|integer',
            'depto.icono' => 'nullable|string|max:100',
            'depto.orden' => 'required|integer|min:0',
            'depto.visible' => 'boolean',
            'depto.lMesas' => 'boolean',
            'depto.lMostrador' => 'boolean',
            'depto.lPOS' => 'boolean',
            'depto.lDelivery' => 'boolean',
            'depto.lWeb' => 'boolean',
            'depto.lCarDig' => 'boolean',
            'depto.descuento' => 'required|numeric|min:0|max:100',
            'depto.lVendido' => 'boolean',
            'depto.lPromo' => 'boolean',
            'depto.lNuevo' => 'boolean',
            'depto.lVegetariano' => 'boolean',
            'depto.lTacc' => 'boolean',
            'depto.lVegano' => 'boolean',
            'depto.lLactosa' => 'boolean',
            'depto.lKosher' => 'boolean',
            'depto.lFrutos' => 'boolean',
            'depto.cantidad_iconos' => 'required|integer|min:0',
        ];
    }

    // Mensajes personalizados para la validación
    protected $messages = [
        'depto.nombre.required' => 'El nombre del departamento es obligatorio.',
        'depto.nombre.max' => 'El nombre no puede tener más de 30 caracteres.',
        'depto.resumido.max' => 'El nombre resumido no puede tener más de 12 caracteres.',
        'depto.orden.required' => 'El orden es obligatorio.',
        'depto.orden.integer' => 'El orden debe ser un número entero.',
        'depto.descuento.numeric' => 'El descuento debe ser un valor numérico.',
        'depto.descuento.min' => 'El descuento no puede ser menor a 0.',
        'depto.descuento.max' => 'El descuento no puede ser mayor a 100.',
    ];

    // Cargar IVAs filtrados al escribir en el campo de búsqueda
    public function updatedSearchIva()
    {
        if (empty($this->searchIva) && !$this->selectedIvaName) {
            // Si el campo está vacío y no hay selección, mostrar todos los IVA (limitado a 10 registros)
            $this->ivas = Iva::orderBy('nombre')->take(10)->get();
            $this->showIvaDropdown = true;
        } else if (strlen($this->searchIva) >= 1) {
            // Si hay texto de búsqueda, filtrar los resultados
            $this->ivas = Iva::where('nombre', 'like', '%' . $this->searchIva . '%')
                ->orWhere('tasa', 'like', '%' . $this->searchIva . '%')
                ->take(10)
                ->get();
            
            $this->showIvaDropdown = true;
        } else {
            // Ocultar el dropdown si hay un valor seleccionado y el campo está vacío
            $this->showIvaDropdown = false;
        }
    }

    public function showIvaOptions()
    {
        if (!$this->selectedIvaName) {
            $this->ivas = Iva::orderBy('nombre')->take(10)->get();
            $this->showIvaDropdown = true;
        }
    }

    // Seleccionar un IVA de la lista
    public function selectIva($codigo, $nombre)
    {
        $this->depto['iva'] = $codigo;
        $this->selectedIvaName = $nombre;
        $this->searchIva = '';
        $this->showIvaDropdown = false;
    }

    public function clearIvaSelection()
    {
        $this->depto['iva'] = null;
        $this->selectedIvaName = '';
        $this->searchIva = '';
        $this->showIvaOptions();
    }

    // Resetear la paginación cuando se busca
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Ordenar resultados
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    // Abrir modal para crear departamento
    public function createDepto()
    {
        $this->reset(['depto', 'isEditing', 'selectedIvaName', 'searchIva']);
        $this->depto = [
            'codigo' => null,
            'nombre' => '',
            'resumido' => '',
            'iva' => null,
            'icono' => '',
            'orden' => 0,
            'visible' => true,
            'lMesas' => true,
            'lMostrador' => true,
            'lPOS' => true,
            'lDelivery' => true,
            'lWeb' => true,
            'lCarDig' => true,
            'descuento' => 0.00,
            'lVendido' => false,
            'lPromo' => false,
            'lNuevo' => false,
            'lVegetariano' => false,
            'lTacc' => false,
            'lVegano' => false,
            'lLactosa' => false,
            'lKosher' => false,
            'lFrutos' => false,
            'cantidad_iconos' => 0,
        ];
        $this->isEditing = false;
        $this->showModalForm = true;
    }

    // Abrir modal para editar departamento
    public function editDepto($id)
    {
        $this->isEditing = true;
        $deptoToEdit = Depto::findOrFail($id);
        $this->depto = $deptoToEdit->toArray();
        
        // Cargar el nombre del IVA si existe
        if ($this->depto['iva']) {
            $iva = Iva::find($this->depto['iva']);
            if ($iva) {
                $this->selectedIvaName = $iva->nombre;
            }
        }
        
        $this->showModalForm = true;
    }

    // Guardar o actualizar departamento
    public function saveDepto()
    {
        $this->validate();
        
        try {
            DB::beginTransaction();
            
            // Lista de campos de íconos que queremos contar
            $iconFields = [
                'lVendido', 'lPromo', 'lNuevo', 'lVegetariano', 
                'lTacc', 'lVegano', 'lLactosa', 'lKosher', 'lFrutos'
            ];
            
            // Contar cuántos están en true
            $iconsCount = 0;
            foreach ($iconFields as $field) {
                if (isset($this->depto[$field]) && $this->depto[$field] === true) {
                    $iconsCount++;
                }
            }
            
            // Asignar el conteo al campo cantidad_iconos
            $this->depto['cantidad_iconos'] = $iconsCount;
            
            if ($this->isEditing) {
                $depto = Depto::findOrFail($this->depto['codigo']);
                $depto->update($this->depto);
                $message = 'Departamento actualizado correctamente';
            } else {
                Depto::create($this->depto);
                $message = 'Departamento creado correctamente';
            }
            
            DB::commit();
            $this->showModalForm = false;
            $this->dispatch('notify', [
                'type' => 'success', 
                'message' => $message
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', [
                'type' => 'error', 
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // Confirmar eliminación
    public function confirmDelete($id)
    {
        $this->deptoIdToDelete = $id;
        $this->confirmingDeletion = true;
    }

    // Eliminar departamento
    public function deleteDepto()
    {
        try {
            // Verificar si hay artículos que dependan de este departamento
            $articlesCount = DB::table('articulos')
                ->where('depto', $this->deptoIdToDelete)
                ->count();
                
            if ($articlesCount > 0) {
                $this->dispatch('notify', [
                    'type' => 'error', 
                    'message' => 'No se puede eliminar el departamento porque tiene artículos asociados'
                ]);
                $this->confirmingDeletion = false;
                return;
            }
            
            $depto = Depto::findOrFail($this->deptoIdToDelete);
            $depto->delete();
            
            $this->confirmingDeletion = false;
            $this->dispatch('notify', [
                'type' => 'success', 
                'message' => 'Departamento eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error', 
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // Cerrar modales
    public function closeModal()
    {
        $this->showModalForm = false;
        $this->confirmingDeletion = false;
        $this->searchIva = '';
        $this->showIvaDropdown = false;
    }

    // Renderizar componente
    public function render()
    {
        $deptos = Depto::when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('resumido', 'like', '%' . $this->search . '%')
                      ->orWhere('codigo', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
            
        return view('livewire.departamentos', [
            'deptos' => $deptos
        ]);
    }
}