<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AuditoriaReservaQuirofano
 * 
 * @property int $id
 * @property int $created_by
 * @property int|null $motivo_cancelacion_quirofano_id
 * @property int|null $quirofano
 * @property Carbon $fecha_hora_estado
 * @property Carbon|null $fecha_hora_inicio
 * @property Carbon|null $fecha_hora_fin
 * @property Carbon $created_at
 * @property string $estado
 * @property string|null $justificacion
 * @property int $reservaQuirofano_id
 * 
 * @property InternacionMotivocancelacionquirofano|null $internacion_motivocancelacionquirofano
 * @property InternacionQuirofano|null $internacion_quirofano
 * @property Usuario $usuario
 * @property ReservaQuirofano $reserva_quirofano
 *
 * @package App\Models
 */
class AuditoriaReservaQuirofano extends Model
{
	protected $table = 'auditoria_reserva_quirofano';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'motivo_cancelacion_quirofano_id' => 'int',
		'quirofano' => 'int',
		'fecha_hora_estado' => 'datetime',
		'fecha_hora_inicio' => 'datetime',
		'fecha_hora_fin' => 'datetime',
		'reservaQuirofano_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'motivo_cancelacion_quirofano_id',
		'quirofano',
		'fecha_hora_estado',
		'fecha_hora_inicio',
		'fecha_hora_fin',
		'estado',
		'justificacion',
		'reservaQuirofano_id'
	];

	public function internacion_motivocancelacionquirofano()
	{
		return $this->belongsTo(InternacionMotivocancelacionquirofano::class, 'motivo_cancelacion_quirofano_id');
	}

	public function internacion_quirofano()
	{
		return $this->belongsTo(InternacionQuirofano::class, 'quirofano');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class, 'reservaQuirofano_id');
	}
}
