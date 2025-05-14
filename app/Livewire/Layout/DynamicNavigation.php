<?php

namespace App\Livewire\Layout;

use App\Livewire\Actions\Logout;
use App\Models\MenuEstructura;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DynamicNavigation extends Component
{
    public $mobileMenuOpen = false;
    public $dropdownStates = [];
    public $menuItems = [];
    public $debugInfo = [];
    public $selectedMenu = null; // Añadimos esta propiedad

    // Asegurarnos de que se preserva el estado entre las renderizaciones
    protected $preserveState = true;
    
    // Escuchar eventos para mantener sincronizado el menú seleccionado
    protected $listeners = ['menuWasSelected' => 'updateSelectedMenu'];
    
    public function mount()
    {
        // Obtener el menú seleccionado de la URL si existe
        $this->selectedMenu = request()->query('menu');
        
        $this->loadMenu();
        
        // Si hay un menú seleccionado en la URL, emitir evento para cargar submenu
        if ($this->selectedMenu) {
            $this->dispatch('menuSelected', $this->selectedMenu);
        }
    }
    
    private function loadMenu()
    {
        // Obtener el usuario actual
        $user = Auth::user();
        
        if (!$user) {
            $this->debugInfo[] = "No hay usuario autenticado";
            return;
        }
        
        $this->debugInfo[] = "Usuario autenticado: " . $user->user;
        
        // Usar una consulta SQL directa para obtener los menús principales
        $mainMenus = DB::select("
            SELECT * FROM menu_estructura
            WHERE usuario = ? AND padre = codigo
            ORDER BY codigo
        ", [$user->user]);
        
        $this->debugInfo[] = "Menús principales encontrados: " . count($mainMenus);
        
        // Convertir los registros a objetos MenuEstructura
        $menuItems = [];
        foreach ($mainMenus as $menu) {
            $menuModel = new MenuEstructura((array)$menu);
            
            // IMPORTANTE: Asegúrate de filtrar por usuario también en los submenús
            $children = DB::select("
                SELECT * FROM menu_estructura
                WHERE usuario = ? AND padre = ? AND codigo != padre
                ORDER BY codigo
            ", [$user->user, $menu->codigo]);
            
            // Convertir los hijos a objetos MenuEstructura
            $childModels = [];
            foreach ($children as $child) {
                $childModels[] = new MenuEstructura((array)$child);
            }
            
            // Asignar los hijos manualmente
            $menuModel->setRelation('children', collect($childModels));
            
            $menuItems[] = $menuModel;
            
            $this->debugInfo[] = "- Menú {$menuModel->etiqueta} (Código: {$menuModel->codigo}) tiene " . count($childModels) . " hijos";
        }
        
        $this->menuItems = collect($menuItems);
        
        // Inicializar estados de los menús desplegables
        $this->initializeDropdownStates($this->menuItems);
    }
    
    // Añadir un método para asignar manualmente relaciones si no lo tienes en el modelo
    private function setRelation($model, $relation, $value)
    {
        if (method_exists($model, 'setRelation')) {
            $model->setRelation($relation, $value);
        } else {
            $model->relations[$relation] = $value;
        }
        
        return $model;
    }
    
    private function initializeDropdownStates($items, $prefix = '')
    {
        foreach ($items as $item) {
            // Usar código en lugar de id para el estado del menú
            $stateKey = $prefix . $item->codigo;
            $this->dropdownStates[$stateKey] = false;
            
            // Si tiene hijos, inicializar su estado también
            if (isset($item->children) && $item->children->count() > 0) {
                $this->initializeDropdownStates($item->children, $stateKey . '_');
            }
        }
    }
        
    public function toggleMobileMenu()
    {
        $this->mobileMenuOpen = !$this->mobileMenuOpen;
    }
    
    public function toggleDropdown($menu)
    {
        // Asegúrate de que el estado existe antes de intentar cambiarlo
        if (!isset($this->dropdownStates[$menu])) {
            $this->dropdownStates[$menu] = false;
        }
        
        $this->dropdownStates[$menu] = !$this->dropdownStates[$menu];
        $this->dispatch('dropdownToggled', $menu);
    }
    
    // Método para seleccionar un menú principal y enviar evento
    public function selectMenu($codigo)
    {
        $this->selectedMenu = $codigo;
        
        // Emitir un evento para que el dashboard pueda reaccionar
        $this->dispatch('menuSelected', $codigo);
        
        // En lugar de redireccionar, solo actualizar la URL
        // Usamos JavaScript para actualizar la URL sin hacer un refresh completo
        $this->dispatch('urlUpdate', [
            'url' => request()->url() . '?menu=' . $codigo
        ]);
    }
    
    // Método para actualizar el menú seleccionado (usado para sincronización)
    public function updateSelectedMenu($menuCode)
    {
        $this->selectedMenu = $menuCode;
    }
    
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
    
    public function render()
    {
        return view('livewire.layout.dynamic-navigation');
    }
}