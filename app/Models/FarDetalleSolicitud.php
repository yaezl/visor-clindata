<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarDetalleSolicitud
 * 
 * @property int $id
 * @property int|null $solicitud_medicamento_id
 * @property int|null $atp_id
 * @property Carbon $fecha
 * @property float $cantidad
 * @property int $duracion
 * @property int $frecuencia
 * @property Carbon $hora
 * @property bool $activo
 * @property int $prescripcion_id
 * @property bool $interrumpido
 * @property Carbon|null $fecha_interrupcion
 * @property bool $entrega_paciente
 * @property int|null $almacen_a_solicitar
 * 
 * @property Almacen|null $almacen
 * @property FarSolicitudMedicamento|null $far_solicitud_medicamento
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Articuloprescripto $articuloprescripto
 * @property Collection|BonoDetallesolicitud[] $bono_detallesolicituds
 * @property Collection|FarDetalleSolicitudTurno[] $far_detalle_solicitud_turnos
 * @property Collection|FarEdicionEnvioSolicitud[] $far_edicion_envio_solicituds
 *
 * @package App\Models
 */
class FarDetalleSolicitud extends Model
{
	protected $table = 'far_detalle_solicitud';
	public $timestamps = false;

	protected $casts = [
		'solicitud_medicamento_id' => 'int',
		'atp_id' => 'int',
		'fecha' => 'datetime',
		'cantidad' => 'float',
		'duracion' => 'int',
		'frecuencia' => 'int',
		'hora' => 'datetime',
		'activo' => 'bool',
		'prescripcion_id' => 'int',
		'interrumpido' => 'bool',
		'fecha_interrupcion' => 'datetime',
		'entrega_paciente' => 'bool',
		'almacen_a_solicitar' => 'int'
	];

	protected $fillable = [
		'solicitud_medicamento_id',
		'atp_id',
		'fecha',
		'cantidad',
		'duracion',
		'frecuencia',
		'hora',
		'activo',
		'prescripcion_id',
		'interrumpido',
		'fecha_interrupcion',
		'entrega_paciente',
		'almacen_a_solicitar'
	];

	public function almacen()
	{
		return $this->belongsTo(Almacen::class, 'almacen_a_solicitar');
	}

	public function far_solicitud_medicamento()
	{
		return $this->belongsTo(FarSolicitudMedicamento::class, 'solicitud_medicamento_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}

	public function articuloprescripto()
	{
		return $this->belongsTo(Articuloprescripto::class, 'prescripcion_id');
	}

	public function bono_detallesolicituds()
	{
		return $this->hasMany(BonoDetallesolicitud::class, 'detallesolicitud_id');
	}

	public function far_detalle_solicitud_turnos()
	{
		return $this->hasMany(FarDetalleSolicitudTurno::class, 'detalle_solicitud_id');
	}

	public function far_edicion_envio_solicituds()
	{
		return $this->hasMany(FarEdicionEnvioSolicitud::class, 'detalle_solicitud_id');
	}
}
