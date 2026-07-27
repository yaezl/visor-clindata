<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FarCierreInventarioAtp
 * 
 * @property int $id
 * @property int|null $cierre_inventario_almacen_id
 * @property int|null $atp_id
 * @property float $teorico
 * @property float $setpoint
 * 
 * @property FarCierreInventarioAlmacen|null $far_cierre_inventario_almacen
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 *
 * @package App\Models
 */
class FarCierreInventarioAtp extends Model
{
	protected $table = 'far_cierre_inventario_atp';
	public $timestamps = false;

	protected $casts = [
		'cierre_inventario_almacen_id' => 'int',
		'atp_id' => 'int',
		'teorico' => 'float',
		'setpoint' => 'float'
	];

	protected $fillable = [
		'cierre_inventario_almacen_id',
		'atp_id',
		'teorico',
		'setpoint'
	];

	public function far_cierre_inventario_almacen()
	{
		return $this->belongsTo(FarCierreInventarioAlmacen::class, 'cierre_inventario_almacen_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}
}
