<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AprobacionesEstado
 * 
 * @property int $estado_id
 * @property int $aprobacion_id
 * 
 * @property AutorizacionesEstado $autorizaciones_estado
 * @property AutorizacionesAprobacion $autorizaciones_aprobacion
 *
 * @package App\Models
 */
class AprobacionesEstado extends Model
{
	protected $table = 'aprobaciones_estados';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'estado_id' => 'int',
		'aprobacion_id' => 'int'
	];

	public function autorizaciones_estado()
	{
		return $this->belongsTo(AutorizacionesEstado::class, 'estado_id');
	}

	public function autorizaciones_aprobacion()
	{
		return $this->belongsTo(AutorizacionesAprobacion::class, 'aprobacion_id');
	}
}
