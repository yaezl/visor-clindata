<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SolicitudEstudio
 * 
 * @property int $turno_id
 * @property int $estudio_id
 * 
 * @property Solicitudturno $solicitudturno
 * @property Estudio $estudio
 *
 * @package App\Models
 */
class SolicitudEstudio extends Model
{
	protected $table = 'solicitud_estudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'estudio_id' => 'int'
	];

	public function solicitudturno()
	{
		return $this->belongsTo(Solicitudturno::class, 'turno_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}
}
