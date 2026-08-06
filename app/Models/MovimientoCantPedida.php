<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MovimientoCantPedida
 * 
 * @property int $id
 * @property int|null $movimiento_detalle_id
 * @property float $cantidad
 * 
 * @property Movimientodetalle|null $movimientodetalle
 *
 * @package App\Models
 */
class MovimientoCantPedida extends Model
{
	protected $table = 'movimiento_cant_pedida';
	public $timestamps = false;

	protected $casts = [
		'movimiento_detalle_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'movimiento_detalle_id',
		'cantidad'
	];

	public function movimientodetalle()
	{
		return $this->belongsTo(Movimientodetalle::class, 'movimiento_detalle_id');
	}
}
