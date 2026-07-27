<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionAprobacione
 * 
 * @property int $autorizacion_id
 * @property int $aprobacion_id
 * 
 * @property AutorizacionesAutorizacion $autorizaciones_autorizacion
 * @property AutorizacionesAprobacion $autorizaciones_aprobacion
 *
 * @package App\Models
 */
class AutorizacionAprobacione extends Model
{
	protected $table = 'autorizacion_aprobaciones';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'autorizacion_id' => 'int',
		'aprobacion_id' => 'int'
	];

	public function autorizaciones_autorizacion()
	{
		return $this->belongsTo(AutorizacionesAutorizacion::class, 'autorizacion_id');
	}

	public function autorizaciones_aprobacion()
	{
		return $this->belongsTo(AutorizacionesAprobacion::class, 'aprobacion_id');
	}
}
