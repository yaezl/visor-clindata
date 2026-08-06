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
 * Class PersonaPlan
 * 
 * @property int $id
 * @property int $persona_id
 * @property int $plan_id
 * @property int $tipo_beneficiario_id
 * @property int $tipo_parentesco_id
 * @property string|null $nro_beneficiario
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $condicion_iva_id
 * @property bool $borrado_logico
 * @property int|null $tipo_plan
 * @property int|null $modalidad_contratacion_id
 * @property int|null $plan_beneficios_id
 * @property string|null $codigoSeguridad
 * 
 * @property Usuario $usuario
 * @property PlanDeBeneficio|null $plan_de_beneficio
 * @property ModalidadContratacion|null $modalidad_contratacion
 * @property Persona $persona
 * @property Plan $plan
 * @property TipoBeneficiario $tipo_beneficiario
 * @property TipoParentesco $tipo_parentesco
 * @property Collection|PersonaPlanPorDefecto[] $persona_plan_por_defectos
 *
 * @package App\Models
 */
class PersonaPlan extends Model
{
	use SoftDeletes;
	protected $table = 'persona_plan';

	protected $casts = [
		'persona_id' => 'int',
		'plan_id' => 'int',
		'tipo_beneficiario_id' => 'int',
		'tipo_parentesco_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'condicion_iva_id' => 'int',
		'borrado_logico' => 'bool',
		'tipo_plan' => 'int',
		'modalidad_contratacion_id' => 'int',
		'plan_beneficios_id' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'plan_id',
		'tipo_beneficiario_id',
		'tipo_parentesco_id',
		'nro_beneficiario',
		'created_by',
		'modified_by',
		'deleted_by',
		'condicion_iva_id',
		'borrado_logico',
		'tipo_plan',
		'modalidad_contratacion_id',
		'plan_beneficios_id',
		'codigoSeguridad'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function plan_de_beneficio()
	{
		return $this->belongsTo(PlanDeBeneficio::class, 'plan_beneficios_id');
	}

	public function modalidad_contratacion()
	{
		return $this->belongsTo(ModalidadContratacion::class);
	}

	public function tipo_plan()
	{
		return $this->belongsTo(TipoPlan::class, 'condicion_iva_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function tipo_beneficiario()
	{
		return $this->belongsTo(TipoBeneficiario::class);
	}

	public function tipo_parentesco()
	{
		return $this->belongsTo(TipoParentesco::class);
	}

	public function persona_plan_por_defectos()
	{
		return $this->hasMany(PersonaPlanPorDefecto::class);
	}
}
