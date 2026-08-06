<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHabitacionEtiquetum
 * 
 * @property int $habitacion_id
 * @property int $etiqueta_id
 * 
 * @property InternacionHabitacion $internacion_habitacion
 * @property InternacionEtiquetum $internacion_etiquetum
 *
 * @package App\Models
 */
class InternacionHabitacionEtiquetum extends Model
{
	protected $table = 'internacion_habitacion_etiqueta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'habitacion_id' => 'int',
		'etiqueta_id' => 'int'
	];

	public function internacion_habitacion()
	{
		return $this->belongsTo(InternacionHabitacion::class, 'habitacion_id');
	}

	public function internacion_etiquetum()
	{
		return $this->belongsTo(InternacionEtiquetum::class, 'etiqueta_id');
	}
}
