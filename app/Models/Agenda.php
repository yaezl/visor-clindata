<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Agenda
 * 
 * @property int $id
 * @property int|null $asignacion_id
 * @property int|null $lugar_id
 * @property int $dia
 * @property Carbon $hora_inicio
 * @property Carbon $hora_fin
 * @property Carbon $inicio_vigencia
 * @property Carbon $fin_vigencia
 * @property int $duracion_turno
 * @property int $limite_pacientes
 * @property int $frecuencia
 * @property bool $a_demanda
 * @property string|null $comentario
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $por_callcenter
 * @property int $cant_por_callcenter
 * @property int|null $limite_dias
 * @property int $turnos_por_bloque
 * @property int|null $piso_id
 * @property int|null $area_servicio_id
 * @property bool $agenda_ad_hoc
 * 
 * @property Piso|null $piso
 * @property AreaServicio|null $area_servicio
 * @property Asignacion|null $asignacion
 * @property Lugar|null $lugar
 * @property Collection|ReglaAgenda[] $regla_agendas
 * @property Collection|Turneroasignacion[] $turneroasignacions
 * @property Collection|TurnoProgramado[] $turno_programados
 * @property Collection|TurnosSugerencium[] $turnos_sugerencia
 *
 * @package App\Models
 */
class Agenda extends Model
{
	use SoftDeletes;
	protected $table = 'agenda';

	protected $casts = [
		'asignacion_id' => 'int',
		'lugar_id' => 'int',
		'dia' => 'int',
		'hora_inicio' => 'datetime',
		'hora_fin' => 'datetime',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'duracion_turno' => 'int',
		'limite_pacientes' => 'int',
		'frecuencia' => 'int',
		'a_demanda' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'por_callcenter' => 'bool',
		'cant_por_callcenter' => 'int',
		'limite_dias' => 'int',
		'turnos_por_bloque' => 'int',
		'piso_id' => 'int',
		'area_servicio_id' => 'int',
		'agenda_ad_hoc' => 'bool'
	];

	protected $fillable = [
		'asignacion_id',
		'lugar_id',
		'dia',
		'hora_inicio',
		'hora_fin',
		'inicio_vigencia',
		'fin_vigencia',
		'duracion_turno',
		'limite_pacientes',
		'frecuencia',
		'a_demanda',
		'comentario',
		'created_by',
		'modified_by',
		'deleted_by',
		'por_callcenter',
		'cant_por_callcenter',
		'limite_dias',
		'turnos_por_bloque',
		'piso_id',
		'area_servicio_id',
		'agenda_ad_hoc'
	];

	public function piso()
	{
		return $this->belongsTo(Piso::class);
	}

	public function area_servicio()
	{
		return $this->belongsTo(AreaServicio::class);
	}

	public function asignacion()
	{
		return $this->belongsTo(Asignacion::class);
	}

	public function lugar()
	{
		return $this->belongsTo(Lugar::class);
	}

	public function regla_agendas()
	{
		return $this->hasMany(ReglaAgenda::class);
	}

	public function turneroasignacions()
	{
		return $this->hasMany(Turneroasignacion::class);
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}

	public function turnos_sugerencia()
	{
		return $this->hasMany(TurnosSugerencium::class);
	}
}
