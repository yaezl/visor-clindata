<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StkCierreInventarioAtp
 * 
 * @property int $id
 * @property int|null $cierre_inventario_almacen_id
 * @property int|null $atp_id
 * @property float $teorico
 * @property float $setpoint
 *
 * @package App\Models
 */
class StkCierreInventarioAtp extends Model
{
	protected $table = 'stk_cierre_inventario_atp';
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
}
