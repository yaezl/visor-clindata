<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosRenglonSolicitud
 * 
 * @property int $id
 * @property int|null $solicitud_de_compra_id
 * @property int|null $suministro_id
 * @property int|null $estado_id
 * @property int|null $proveedor_id
 * @property int|null $programa_id
 * @property int|null $proyecto_id
 * @property int|null $centro_de_costo_id
 * @property int|null $grupo_id
 * @property int|null $cuenta_de_gasto_id
 * @property int|null $subcuenta_de_gasto_id
 * @property int|null $renglon_orden_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property float $cantidad
 * @property float|null $precio
 * @property float|null $precioReal
 * @property string|null $comprobante
 * @property string|null $comentarios
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosRenglonSolicitud extends Model
{
	protected $table = 'suministros_renglon_solicitud';
	public $timestamps = false;

	protected $casts = [
		'solicitud_de_compra_id' => 'int',
		'suministro_id' => 'int',
		'estado_id' => 'int',
		'proveedor_id' => 'int',
		'programa_id' => 'int',
		'proyecto_id' => 'int',
		'centro_de_costo_id' => 'int',
		'grupo_id' => 'int',
		'cuenta_de_gasto_id' => 'int',
		'subcuenta_de_gasto_id' => 'int',
		'renglon_orden_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'cantidad' => 'float',
		'precio' => 'float',
		'precioReal' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'solicitud_de_compra_id',
		'suministro_id',
		'estado_id',
		'proveedor_id',
		'programa_id',
		'proyecto_id',
		'centro_de_costo_id',
		'grupo_id',
		'cuenta_de_gasto_id',
		'subcuenta_de_gasto_id',
		'renglon_orden_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'cantidad',
		'precio',
		'precioReal',
		'comprobante',
		'comentarios',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
