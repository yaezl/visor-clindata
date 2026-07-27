<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionDerivaExcluida
 * 
 * @property int $institucion_id
 * @property int $institucion_excluida_id
 * 
 * @property Institucion $institucion
 *
 * @package App\Models
 */
class InstitucionDerivaExcluida extends Model
{
	protected $table = 'institucion_deriva_excluidas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'institucion_excluida_id' => 'int'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class, 'institucion_excluida_id');
	}
}
