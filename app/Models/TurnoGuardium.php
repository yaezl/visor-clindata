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
 * Class TurnoGuardium
 * 
 * @property int $id
 * @property int|null $prioridad_id
 * @property int|null $especialidad_id
 * @property int|null $persona_id
 * @property int|null $plan_id
 * @property int|null $estado_turno_id
 * @property int $orden
 * @property Carbon $fecha
 * @property int $fk_encuentro
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * 
 * @property Prioridad|null $prioridad
 * @property Especialidad|null $especialidad
 * @property Persona|null $persona
 * @property Plan|null $plan
 * @property EstadoTurno|null $estado_turno
 * @property Collection|Bono[] $bonos
 *
 * @package App\Models
 */
class TurnoGuardium extends Model
{
	use SoftDeletes;
	protected $table = 'turno_guardia';

	protected $casts = [
		'prioridad_id' => 'int',
		'especialidad_id' => 'int',
		'persona_id' => 'int',
		'plan_id' => 'int',
		'estado_turno_id' => 'int',
		'orden' => 'int',
		'fecha' => 'datetime',
		'fk_encuentro' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'prioridad_id',
		'especialidad_id',
		'persona_id',
		'plan_id',
		'estado_turno_id',
		'orden',
		'fecha',
		'fk_encuentro',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function prioridad()
	{
		return $this->belongsTo(Prioridad::class);
	}

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function estado_turno()
	{
		return $this->belongsTo(EstadoTurno::class);
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class, 'turnoguardia_id');
	}
}
