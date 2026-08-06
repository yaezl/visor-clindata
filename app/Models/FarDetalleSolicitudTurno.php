<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FarDetalleSolicitudTurno
 * 
 * @property int $id
 * @property int|null $detalle_solicitud_id
 * @property int|null $solicitud_turno_id
 * @property int|null $detalle_hoja_solicitud_id
 * 
 * @property FarDetalleSolicitud|null $far_detalle_solicitud
 * @property FarSolicitudTurno|null $far_solicitud_turno
 * @property FarDetalleHojaSolicitud|null $far_detalle_hoja_solicitud
 *
 * @package App\Models
 */
class FarDetalleSolicitudTurno extends Model
{
	protected $table = 'far_detalle_solicitud_turno';
	public $timestamps = false;

	protected $casts = [
		'detalle_solicitud_id' => 'int',
		'solicitud_turno_id' => 'int',
		'detalle_hoja_solicitud_id' => 'int'
	];

	protected $fillable = [
		'detalle_solicitud_id',
		'solicitud_turno_id',
		'detalle_hoja_solicitud_id'
	];

	public function far_detalle_solicitud()
	{
		return $this->belongsTo(FarDetalleSolicitud::class, 'detalle_solicitud_id');
	}

	public function far_solicitud_turno()
	{
		return $this->belongsTo(FarSolicitudTurno::class, 'solicitud_turno_id');
	}

	public function far_detalle_hoja_solicitud()
	{
		return $this->belongsTo(FarDetalleHojaSolicitud::class, 'detalle_hoja_solicitud_id');
	}
}
