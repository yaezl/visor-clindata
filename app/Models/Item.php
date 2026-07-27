<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 
 * @property int $id
 * 
 * @property Dinero|null $dinero
 * @property Lote|null $lote
 * @property Collection|Movimientodetalle[] $movimientodetalles
 * @property StkLote|null $stk_lote
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'item';
	public $timestamps = false;

	public function dinero()
	{
		return $this->hasOne(Dinero::class);
	}

	public function lote()
	{
		return $this->hasOne(Lote::class);
	}

	public function movimientodetalles()
	{
		return $this->hasMany(Movimientodetalle::class);
	}

	public function stk_lote()
	{
		return $this->hasOne(StkLote::class);
	}
}
