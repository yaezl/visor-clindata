<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movimientodetalle
 * 
 * @property int $id
 * @property int|null $movimiento_id
 * @property int|null $item_id
 * @property float $cantidad
 * 
 * @property Movimiento|null $movimiento
 * @property Item|null $item
 * @property Lote|null $lote
 * @property MovimientoCantPedida|null $movimiento_cant_pedida
 * @property StkLote|null $stk_lote
 *
 * @package App\Models
 */
class Movimientodetalle extends Model
{
	protected $table = 'movimientodetalle';
	public $timestamps = false;

	protected $casts = [
		'movimiento_id' => 'int',
		'item_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'movimiento_id',
		'item_id',
		'cantidad'
	];

	public function movimiento()
	{
		return $this->belongsTo(Movimiento::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function lote()
	{
		return $this->hasOne(Lote::class);
	}

	public function movimiento_cant_pedida()
	{
		return $this->hasOne(MovimientoCantPedida::class, 'movimiento_detalle_id');
	}

	public function stk_lote()
	{
		return $this->hasOne(StkLote::class);
	}
}
