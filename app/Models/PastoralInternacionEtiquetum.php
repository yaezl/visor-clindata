<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralInternacionEtiquetum
 * 
 * @property int $personainternacion_id
 * @property int $etiqueta_id
 * 
 * @property InternacionPersona $internacion_persona
 * @property PastoralEtiquetum $pastoral_etiquetum
 *
 * @package App\Models
 */
class PastoralInternacionEtiquetum extends Model
{
	protected $table = 'pastoral_internacion_etiqueta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'personainternacion_id' => 'int',
		'etiqueta_id' => 'int'
	];

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'personainternacion_id');
	}

	public function pastoral_etiquetum()
	{
		return $this->belongsTo(PastoralEtiquetum::class, 'etiqueta_id');
	}
}
