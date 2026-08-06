<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleadorcuentum
 * 
 * @property int $id
 * @property int|null $empleador_id
 * 
 * @property Empleador|null $empleador
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class Empleadorcuentum extends Model
{
	protected $table = 'empleadorcuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'empleador_id' => 'int'
	];

	protected $fillable = [
		'empleador_id'
	];

	public function empleador()
	{
		return $this->belongsTo(Empleador::class);
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
