<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StkProveedorcuentum
 * 
 * @property int $id
 * @property int|null $proveedor_id
 * 
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class StkProveedorcuentum extends Model
{
	protected $table = 'stk_proveedorcuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'proveedor_id' => 'int'
	];

	protected $fillable = [
		'proveedor_id'
	];

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
