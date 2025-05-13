<?php

namespace App\Livewire;

use App\Models\MenuEstructura;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SubMenuButtons extends Component
{
    public $selectedMenu = null;
    public $subMenus = [];
    public $menuTitle = '';
    
    protected $listeners = ['menuSelected' => 'loadSubMenus'];
    
    public function loadSubMenus($menuCode)
    {
        $this->selectedMenu = $menuCode;
        
        // Sincronizar con el menú principal
        $this->dispatch('menuWasSelected', $menuCode);
        
        $user = Auth::user();
        if (!$user) {
            return;
        }
        
        // Obtener el título del menú seleccionado
        $menuData = DB::select("SELECT etiqueta FROM menu_estructura WHERE codigo = ? AND usuario = ?", 
            [$menuCode, $user->user]);
            
        if (count($menuData) > 0) {
            $this->menuTitle = $menuData[0]->etiqueta;
        }
        
        // Cargar los submenús del menú seleccionado
        $subMenus = DB::select("
            SELECT * FROM menu_estructura
            WHERE usuario = ? AND padre = ? AND codigo != padre
            ORDER BY codigo
        ", [$user->user, $menuCode]);
        
        $this->subMenus = collect($subMenus)->map(function($item) {
            return new MenuEstructura((array)$item);
        });
    }
    
    public function render()
    {
        return view('livewire.sub-menu-buttons');
    }
}