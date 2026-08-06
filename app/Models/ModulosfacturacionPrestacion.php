<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ModulosfacturacionPrestacion
 * 
 * @property int $id
 * @property int $modulofacturacion_id
 * @property int $prestacion_id
 * @property int $cantidad
 * @property string $precio
 * @property bool $borrado_logico
 * 
 * @property Prestacion $prestacion
 * @property ModulosFacturacion $modulos_facturacion
 *
 * @package App\Models
 */
class ModulosfacturacionPrestacion extends Model
{
	protected $table = 'modulosfacturacion_prestacion';
	public $timestamps = false;

	protected $casts = [
		'modulofacturacion_id' => 'int',
		'prestacion_id' => 'int',
		'cantidad' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'modulofacturacion_id',
		'prestacion_id',
		'cantidad',
		'precio',
		'borrado_logico'
	];

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function modulos_facturacion()
	{
		return $this->belongsTo(ModulosFacturacion::class, 'modulofacturacion_id');
	}
}
