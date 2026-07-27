<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedorcuentum
 * 
 * @property int $id
 * @property int|null $proveedor_id
 * 
 * @property Proveedor|null $proveedor
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class Proveedorcuentum extends Model
{
	protected $table = 'proveedorcuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'proveedor_id' => 'int'
	];

	protected $fillable = [
		'proveedor_id'
	];

	public function proveedor()
	{
		return $this->belongsTo(Proveedor::class);
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
