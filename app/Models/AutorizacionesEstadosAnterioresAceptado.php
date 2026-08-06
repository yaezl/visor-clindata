<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesEstadosAnterioresAceptado
 * 
 * @property int $estado_id
 * @property int $estado_anterior_id
 * 
 * @property AutorizacionesEstado $autorizaciones_estado
 *
 * @package App\Models
 */
class AutorizacionesEstadosAnterioresAceptado extends Model
{
	protected $table = 'autorizaciones_estados_anteriores_aceptados';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'estado_id' => 'int',
		'estado_anterior_id' => 'int'
	];

	public function autorizaciones_estado()
	{
		return $this->belongsTo(AutorizacionesEstado::class, 'estado_id');
	}
}
