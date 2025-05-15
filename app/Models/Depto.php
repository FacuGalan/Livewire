<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depto extends Model
{
    use HasFactory;
    
    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'deptos';
    
    /**
     * La clave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'codigo';
    
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'resumido',
        'iva',
        'icono',
        'orden',
        'visible',
        'lMesas',
        'lMostrador',
        'lPOS',
        'lDelivery',
        'lWeb',
        'lCarDig',
        'descuento',
        'lVendido',
        'lPromo',
        'lNuevo',
        'lVegetariano',
        'lTacc',
        'lVegano',
        'lLactosa',
        'lKosher',
        'lFrutos',
        'cantidad_iconos',
    ];
    
    /**
     * Los atributos que deben convertirse.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'boolean',
        'lMesas' => 'boolean',
        'lMostrador' => 'boolean',
        'lPOS' => 'boolean',
        'lDelivery' => 'boolean',
        'lWeb' => 'boolean',
        'lCarDig' => 'boolean',
        'lVendido' => 'boolean',
        'lPromo' => 'boolean',
        'lNuevo' => 'boolean',
        'lVegetariano' => 'boolean',
        'lTacc' => 'boolean',
        'lVegano' => 'boolean',
        'lLactosa' => 'boolean',
        'lKosher' => 'boolean',
        'lFrutos' => 'boolean',
        'descuento' => 'decimal:2',
    ];
    
    /**
     * Obtener los artículos asociados con este departamento.
     */
    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'depto', 'codigo');
    }

    /**
     * Obtener el IVA asociado con este departamento.
     */
    public function iva()
    {
        return $this->belongsTo(Iva::class, 'iva', 'codigo');
    }
}