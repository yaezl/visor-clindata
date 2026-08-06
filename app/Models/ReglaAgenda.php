<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgenda
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $agenda_id
 * @property bool $bloqueante_sugerencias
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property string $dtype
 * @property int|null $prioridad_id
 * 
 * @property Usuario|null $usuario
 * @property PrioridadReglaAgenda|null $prioridad_regla_agenda
 * @property Agenda|null $agenda
 * @property ReglaAgendaCiudad|null $regla_agenda_ciudad
 * @property ReglaAgendaEdad|null $regla_agenda_edad
 * @property Collection|Plan[] $plans
 * @property ReglaAgendaPlanListaBlanca|null $regla_agenda_plan_lista_blanca
 * @property ReglaAgendaPracticaLimite|null $regla_agenda_practica_limite
 * @property ReglaAgendaPrimeraVez|null $regla_agenda_primera_vez
 * @property ReglaAgendaPrioridadO|null $regla_agenda_prioridad_o
 * @property ReglaAgendaSexo|null $regla_agenda_sexo
 *
 * @package App\Models
 */
class ReglaAgenda extends Model
{
	protected $table = 'regla_agenda';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int',
		'agenda_id' => 'int',
		'bloqueante_sugerencias' => 'bool',
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime',
		'prioridad_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'updated_by',
		'agenda_id',
		'bloqueante_sugerencias',
		'borrado_logico',
		'modified_at',
		'dtype',
		'prioridad_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function prioridad_regla_agenda()
	{
		return $this->belongsTo(PrioridadReglaAgenda::class, 'prioridad_id');
	}

	public function agenda()
	{
		return $this->belongsTo(Agenda::class);
	}

	public function regla_agenda_ciudad()
	{
		return $this->hasOne(ReglaAgendaCiudad::class, 'id');
	}

	public function regla_agenda_edad()
	{
		return $this->hasOne(ReglaAgendaEdad::class, 'id');
	}

	public function plans()
	{
		return $this->belongsToMany(Plan::class, 'regla_agenda_plan', 'id')
					->withPivot('cantidad', 'os_completa');
	}

	public function regla_agenda_plan_lista_blanca()
	{
		return $this->hasOne(ReglaAgendaPlanListaBlanca::class, 'id');
	}

	public function regla_agenda_practica_limite()
	{
		return $this->hasOne(ReglaAgendaPracticaLimite::class, 'id');
	}

	public function regla_agenda_primera_vez()
	{
		return $this->hasOne(ReglaAgendaPrimeraVez::class, 'id');
	}

	public function regla_agenda_prioridad_o()
	{
		return $this->hasOne(ReglaAgendaPrioridadO::class, 'id');
	}

	public function regla_agenda_sexo()
	{
		return $this->hasOne(ReglaAgendaSexo::class, 'id');
	}
}
