<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionDerivaAgregada
 * 
 * @property int $institucion_id
 * @property int $institucion_agregada_id
 * 
 * @property Institucion $institucion
 *
 * @package App\Models
 */
class InstitucionDerivaAgregada extends Model
{
	protected $table = 'institucion_deriva_agregadas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'institucion_agregada_id' => 'int'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
