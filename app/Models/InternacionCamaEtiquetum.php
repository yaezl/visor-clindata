<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionCamaEtiquetum
 * 
 * @property int $cama_id
 * @property int $etiqueta_id
 * 
 * @property InternacionCama $internacion_cama
 * @property InternacionEtiquetum $internacion_etiquetum
 *
 * @package App\Models
 */
class InternacionCamaEtiquetum extends Model
{
	protected $table = 'internacion_cama_etiqueta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cama_id' => 'int',
		'etiqueta_id' => 'int'
	];

	public function internacion_cama()
	{
		return $this->belongsTo(InternacionCama::class, 'cama_id');
	}

	public function internacion_etiquetum()
	{
		return $this->belongsTo(InternacionEtiquetum::class, 'etiqueta_id');
	}
}
