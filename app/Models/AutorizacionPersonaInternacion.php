<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionPersonaInternacion
 * 
 * @property int $autorizacion_id
 * @property int $personaInternaciono_id
 * 
 * @property AutorizacionesAutorizacion $autorizaciones_autorizacion
 * @property InternacionPersona $internacion_persona
 *
 * @package App\Models
 */
class AutorizacionPersonaInternacion extends Model
{
	protected $table = 'autorizacion_personaInternacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'autorizacion_id' => 'int',
		'personaInternaciono_id' => 'int'
	];

	public function autorizaciones_autorizacion()
	{
		return $this->belongsTo(AutorizacionesAutorizacion::class, 'autorizacion_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'personaInternaciono_id');
	}
}
