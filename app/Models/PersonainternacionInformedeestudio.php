<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonainternacionInformedeestudio
 * 
 * @property int $personainternacion_id
 * @property int $informedeestudio_id
 * 
 * @property InternacionPersona $internacion_persona
 * @property Informedeestudio $informedeestudio
 *
 * @package App\Models
 */
class PersonainternacionInformedeestudio extends Model
{
	protected $table = 'personainternacion_informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'personainternacion_id' => 'int',
		'informedeestudio_id' => 'int'
	];

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'personainternacion_id');
	}

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}
}
