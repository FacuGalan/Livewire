<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    
    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'articulos';
    
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
        'codbar',
        'nombre',
        'resumido',
        'depto',
        'iva',
        'lstock',
        'stock',
        'precossiva',
        'porcentaje',
        'precio',
        'sabores',
        'lsabores',
        'lstockR',
        'preciocos',
        'merma',
        'misela',
        'para_delivery',
        'visible',
        'activo',
        'orden',
        'destacado',
        'solo_consulta',
        'observa_web',
        'tiempo_prod',
        'pesable',
        'porcentajew',
        'preciow',
        'para_carta',
        'agotado',
        'stockmin',
        'porcentaje_m',
        'precio_m',
        'solo_efectivo',
        'inactivo',
        'solo_unitario',
        'lMesas',
        'lMostrador',
        'lPOS',
        'lDelivery',
        'solo_takeaway',
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
        'solo_digital',
        'precio_oferta',
        'preciow_oferta',
        'porc_descuentow',
        'preciocd_oferta',
        'preciow_oferta2',
        'porc_descuento',
        'alergenos',
        'preciom_oferta',
        'orden_local',
        'descuenta_de',
        'descuenta_de_cant',
        'lCanjea_puntos',
        'puntos',
        'comision',
    ];
    
    /**
     * Los atributos que deben convertirse.
     *
     * @var array
     */
    protected $casts = [
        'lstock' => 'boolean',
        'lsabores' => 'boolean',
        'lstockR' => 'boolean',
        'para_delivery' => 'boolean',
        'visible' => 'boolean',
        'activo' => 'boolean',
        'destacado' => 'boolean',
        'solo_consulta' => 'boolean',
        'pesable' => 'boolean',
        'para_carta' => 'boolean',
        'agotado' => 'boolean',
        'solo_efectivo' => 'boolean',
        'inactivo' => 'boolean',
        'solo_unitario' => 'boolean',
        'lMesas' => 'boolean',
        'lMostrador' => 'boolean',
        'lPOS' => 'boolean',
        'lDelivery' => 'boolean',
        'solo_takeaway' => 'boolean',
        'lVendido' => 'boolean',
        'lPromo' => 'boolean',
        'lNuevo' => 'boolean',
        'lVegetariano' => 'boolean',
        'lTacc' => 'boolean',
        'lVegano' => 'boolean',
        'lLactosa' => 'boolean',
        'lKosher' => 'boolean',
        'lFrutos' => 'boolean',
        'solo_digital' => 'boolean',
        'lCanjea_puntos' => 'boolean',
        'precossiva' => 'decimal:2',
        'porcentaje' => 'decimal:2',
        'precio' => 'decimal:2',
        'preciocos' => 'decimal:2',
        'merma' => 'decimal:2',
        'misela' => 'decimal:2',
        'porcentajew' => 'decimal:2',
        'preciow' => 'decimal:2',
        'stockmin' => 'decimal:2',
        'porcentaje_m' => 'decimal:2',
        'precio_m' => 'decimal:2',
        'precio_oferta' => 'decimal:2',
        'preciow_oferta' => 'decimal:2',
        'porc_descuentow' => 'decimal:2',
        'preciocd_oferta' => 'decimal:2',
        'preciow_oferta2' => 'decimal:2',
        'porc_descuento' => 'decimal:2',
        'preciom_oferta' => 'decimal:2',
        'descuenta_de_cant' => 'decimal:2',
        'comision' => 'decimal:2',
    ];
    
    /**
     * Obtener el departamento al que pertenece este artículo.
     */
    public function departamento()
    {
        return $this->belongsTo(Depto::class, 'depto', 'codigo');
    }
}