<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Institucioncuentum
 * 
 * @property int $id
 * @property int|null $institucion_id
 * 
 * @property Institucion|null $institucion
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class Institucioncuentum extends Model
{
	protected $table = 'institucioncuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'institucion_id'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
