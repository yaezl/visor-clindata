<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrasocialcuentum
 * 
 * @property int $id
 * @property int|null $obrasocial_id
 * 
 * @property ObraSocial|null $obra_social
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class Obrasocialcuentum extends Model
{
	protected $table = 'obrasocialcuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'obrasocial_id' => 'int'
	];

	protected $fillable = [
		'obrasocial_id'
	];

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class, 'obrasocial_id');
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
