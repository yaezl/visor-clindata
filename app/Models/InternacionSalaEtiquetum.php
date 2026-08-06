<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionSalaEtiquetum
 * 
 * @property int $sala_id
 * @property int $etiqueta_id
 * 
 * @property InternacionSala $internacion_sala
 * @property InternacionEtiquetum $internacion_etiquetum
 *
 * @package App\Models
 */
class InternacionSalaEtiquetum extends Model
{
	protected $table = 'internacion_sala_etiqueta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'sala_id' => 'int',
		'etiqueta_id' => 'int'
	];

	public function internacion_sala()
	{
		return $this->belongsTo(InternacionSala::class, 'sala_id');
	}

	public function internacion_etiquetum()
	{
		return $this->belongsTo(InternacionEtiquetum::class, 'etiqueta_id');
	}
}
