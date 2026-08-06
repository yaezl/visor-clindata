<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TurnosSugerencium
 * 
 * @property int $id
 * @property int|null $turno_id
 * @property int $agenda_id
 * @property int $estado_turno_id
 * @property int $orden
 * @property Carbon $fecha
 * @property Carbon $hora
 * @property bool $sobreturno
 * 
 * @property TurnoProgramado|null $turno_programado
 * @property Agenda $agenda
 * @property EstadoTurno $estado_turno
 *
 * @package App\Models
 */
class TurnosSugerencium extends Model
{
	protected $table = 'turnos_sugerencia';
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'agenda_id' => 'int',
		'estado_turno_id' => 'int',
		'orden' => 'int',
		'fecha' => 'datetime',
		'hora' => 'datetime',
		'sobreturno' => 'bool'
	];

	protected $fillable = [
		'turno_id',
		'agenda_id',
		'estado_turno_id',
		'orden',
		'fecha',
		'hora',
		'sobreturno'
	];

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}

	public function agenda()
	{
		return $this->belongsTo(Agenda::class);
	}

	public function estado_turno()
	{
		return $this->belongsTo(EstadoTurno::class);
	}
}
