<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfesionalPlan
 * 
 * @property int $id
 * @property int|null $personal_id
 * @property int|null $plan_id
 * @property int|null $estudio_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * @property bool $a_todos_planes
 * @property bool $a_todos_os
 * @property Carbon $inicio_vigencia
 * @property Carbon $fin_vigencia
 * @property bool $a_todos_inst
 * @property int|null $institucion_id
 * 
 * @property Usuario|null $usuario
 * @property Personal|null $personal
 * @property Estudio|null $estudio
 * @property Institucion|null $institucion
 * @property Plan|null $plan
 * @property Collection|ProfesionalPlanArancel[] $profesional_plan_arancels
 *
 * @package App\Models
 */
class ProfesionalPlan extends Model
{
	protected $table = 'profesional_plan';

	protected $casts = [
		'personal_id' => 'int',
		'plan_id' => 'int',
		'estudio_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool',
		'a_todos_planes' => 'bool',
		'a_todos_os' => 'bool',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'a_todos_inst' => 'bool',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'personal_id',
		'plan_id',
		'estudio_id',
		'created_by',
		'modified_by',
		'borrado_logico',
		'a_todos_planes',
		'a_todos_os',
		'inicio_vigencia',
		'fin_vigencia',
		'a_todos_inst',
		'institucion_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function profesional_plan_arancels()
	{
		return $this->hasMany(ProfesionalPlanArancel::class);
	}
}
