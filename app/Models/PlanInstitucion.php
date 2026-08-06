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
 * Class PlanInstitucion
 * 
 * @property int $id
 * @property int|null $plan_id
 * @property int|null $institucion_id
 * @property int $dias_de_vencimiento
 * @property bool $es_particular
 * @property bool $copago_variable
 * @property bool $es_por_defecto
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borrado_logico
 * @property bool $planTotem
 * @property string|null $numero_contrato
 * 
 * @property Plan|null $plan
 * @property Institucion|null $institucion
 * @property Collection|ConvenioPlan[] $convenio_plans
 *
 * @package App\Models
 */
class PlanInstitucion extends Model
{
	use SoftDeletes;
	protected $table = 'plan_institucion';

	protected $casts = [
		'plan_id' => 'int',
		'institucion_id' => 'int',
		'dias_de_vencimiento' => 'int',
		'es_particular' => 'bool',
		'copago_variable' => 'bool',
		'es_por_defecto' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borrado_logico' => 'bool',
		'planTotem' => 'bool'
	];

	protected $fillable = [
		'plan_id',
		'institucion_id',
		'dias_de_vencimiento',
		'es_particular',
		'copago_variable',
		'es_por_defecto',
		'created_by',
		'modified_by',
		'deleted_by',
		'borrado_logico',
		'planTotem',
		'numero_contrato'
	];

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function convenio_plans()
	{
		return $this->hasMany(ConvenioPlan::class);
	}
}
