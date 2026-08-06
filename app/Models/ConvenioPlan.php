<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ConvenioPlan
 * 
 * @property int $id
 * @property int $convenio_id
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borrado_logico
 * @property Carbon $inicio_vigencia
 * @property Carbon $fin_vigencia
 * @property int|null $plan_institucion_id
 * 
 * @property Convenio $convenio
 * @property PlanInstitucion|null $plan_institucion
 *
 * @package App\Models
 */
class ConvenioPlan extends Model
{
	use SoftDeletes;
	protected $table = 'convenio_plan';

	protected $casts = [
		'convenio_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borrado_logico' => 'bool',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'plan_institucion_id' => 'int'
	];

	protected $fillable = [
		'convenio_id',
		'created_by',
		'modified_by',
		'deleted_by',
		'borrado_logico',
		'inicio_vigencia',
		'fin_vigencia',
		'plan_institucion_id'
	];

	public function convenio()
	{
		return $this->belongsTo(Convenio::class);
	}

	public function plan_institucion()
	{
		return $this->belongsTo(PlanInstitucion::class);
	}
}
