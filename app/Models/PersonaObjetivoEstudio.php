<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaObjetivoEstudio
 * 
 * @property int $persona_objetivo_id
 * @property int $estudio_id
 * 
 * @property Estudio $estudio
 * @property PersonaObjetivo $persona_objetivo
 *
 * @package App\Models
 */
class PersonaObjetivoEstudio extends Model
{
	protected $table = 'persona_objetivo_estudios';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'persona_objetivo_id' => 'int',
		'estudio_id' => 'int'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function persona_objetivo()
	{
		return $this->belongsTo(PersonaObjetivo::class);
	}
}
