<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Añade esta línea

class MenuEstructura extends Model
{
    protected $table = 'menu_estructura';
    public $timestamps = false;
    
    // Especificar la clave primaria correcta
    protected $primaryKey = 'item'; // Usa el nombre correcto de tu columna de clave primaria
    
    // Si tu clave primaria es 'item' y es autoincremental, no necesitas cambiar nada más
    // Si tu clave primaria no es autoincremental, añade esto:
    // public $incrementing = false;
    
    // Si tu clave primaria no es de tipo entero, añade esto:
    // protected $keyType = 'string';
    
    protected $fillable = [
        'codigo',
        'usuario',
        'modulo',
        'etiqueta',
        'detalle',
        'recurso',
        'padre',
        'permisos',
        'reporte',
    ];
    
    /**
     * Obtener los elementos hijo (submenús)
     */
    public function children()
    {
        // Importante: asegurarse de que filtramos por usuario también
        return $this->hasMany(MenuEstructura::class, 'padre', 'codigo')
                    ->where('codigo', '!=', DB::raw('padre')) 
                    ->where('usuario', auth()->user()->user) // Añade esta línea
                    ->orderBy('codigo');
    }
    
    /**
     * Método para determinar si este elemento tiene submenús
     */
    public function hasChildren()
    {
        // Solo debe devolver true si realmente tiene hijos
        return $this->children && $this->children->count() > 0;
    }
    
    /**
     * Determinar si este es un menú principal
     */
    public function isMainMenu()
    {
        return $this->padre === $this->codigo;
    }
    
    /**
     * Asigna manualmente la relación
     */
    public function setRelation($relation, $value)
    {
        $this->relations[$relation] = $value;
        
        return $this;
    }
}