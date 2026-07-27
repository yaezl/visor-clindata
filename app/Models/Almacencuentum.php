<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Almacencuentum
 * 
 * @property int $id
 * @property int|null $almacen_id
 * 
 * @property Almacen|null $almacen
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class Almacencuentum extends Model
{
	protected $table = 'almacencuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'almacen_id' => 'int'
	];

	protected $fillable = [
		'almacen_id'
	];

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
