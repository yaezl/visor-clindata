<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BonoEstudiointernacion
 * 
 * @property int $estudiointernacion_id
 * @property int $bono_id
 * 
 * @property Bono $bono
 * @property InternacionEstudiosInternacion $internacion_estudios_internacion
 *
 * @package App\Models
 */
class BonoEstudiointernacion extends Model
{
	protected $table = 'bono_estudiointernacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'estudiointernacion_id' => 'int',
		'bono_id' => 'int'
	];

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}

	public function internacion_estudios_internacion()
	{
		return $this->belongsTo(InternacionEstudiosInternacion::class, 'estudiointernacion_id');
	}
}
