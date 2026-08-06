<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StkAlmacencuentum
 * 
 * @property int $id
 * @property int|null $almacen_id
 * 
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class StkAlmacencuentum extends Model
{
	protected $table = 'stk_almacencuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'almacen_id' => 'int'
	];

	protected $fillable = [
		'almacen_id'
	];

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
