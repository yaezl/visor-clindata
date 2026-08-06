<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestadorcuentum
 * 
 * @property int $id
 * @property int|null $prestador_id
 * 
 * @property Cuentum $cuentum
 * @property Prestador|null $prestador
 *
 * @package App\Models
 */
class Prestadorcuentum extends Model
{
	protected $table = 'prestadorcuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'prestador_id' => 'int'
	];

	protected $fillable = [
		'prestador_id'
	];

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}

	public function prestador()
	{
		return $this->belongsTo(Prestador::class);
	}
}
