<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarDetalleHojaSolicitud
 * 
 * @property int $id
 * @property int|null $hoja_solicitud_id
 * @property int|null $sala_destino_id
 * @property int|null $estado_id
 * @property int|null $envio_almacen_id
 * 
 * @property FarHojaSolicitud|null $far_hoja_solicitud
 * @property InternacionSala|null $internacion_sala
 * @property FarEstadoHojaSolicitud|null $far_estado_hoja_solicitud
 * @property Envioaalmacen|null $envioaalmacen
 * @property Collection|FarDetalleSolicitudTurno[] $far_detalle_solicitud_turnos
 *
 * @package App\Models
 */
class FarDetalleHojaSolicitud extends Model
{
	protected $table = 'far_detalle_hoja_solicitud';
	public $timestamps = false;

	protected $casts = [
		'hoja_solicitud_id' => 'int',
		'sala_destino_id' => 'int',
		'estado_id' => 'int',
		'envio_almacen_id' => 'int'
	];

	protected $fillable = [
		'hoja_solicitud_id',
		'sala_destino_id',
		'estado_id',
		'envio_almacen_id'
	];

	public function far_hoja_solicitud()
	{
		return $this->belongsTo(FarHojaSolicitud::class, 'hoja_solicitud_id');
	}

	public function internacion_sala()
	{
		return $this->belongsTo(InternacionSala::class, 'sala_destino_id');
	}

	public function far_estado_hoja_solicitud()
	{
		return $this->belongsTo(FarEstadoHojaSolicitud::class, 'estado_id');
	}

	public function envioaalmacen()
	{
		return $this->belongsTo(Envioaalmacen::class, 'envio_almacen_id');
	}

	public function far_detalle_solicitud_turnos()
	{
		return $this->hasMany(FarDetalleSolicitudTurno::class, 'detalle_hoja_solicitud_id');
	}
}
