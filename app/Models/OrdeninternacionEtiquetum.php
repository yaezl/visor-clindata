<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdeninternacionEtiquetum
 * 
 * @property int $orden_internacion_id
 * @property int $etiqueta_id
 * 
 * @property InternacionOrden $internacion_orden
 * @property InternacionEtiquetum $internacion_etiquetum
 *
 * @package App\Models
 */
class OrdeninternacionEtiquetum extends Model
{
	protected $table = 'ordeninternacion_etiqueta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'orden_internacion_id' => 'int',
		'etiqueta_id' => 'int'
	];

	public function internacion_orden()
	{
		return $this->belongsTo(InternacionOrden::class, 'orden_internacion_id');
	}

	public function internacion_etiquetum()
	{
		return $this->belongsTo(InternacionEtiquetum::class, 'etiqueta_id');
	}
}
