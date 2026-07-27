<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfesionalPlanArancel
 * 
 * @property int $id
 * @property int|null $profesional_plan_id
 * @property int|null $arancel_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property float $valor
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property ArancelMedico|null $arancel_medico
 * @property ProfesionalPlan|null $profesional_plan
 *
 * @package App\Models
 */
class ProfesionalPlanArancel extends Model
{
	protected $table = 'profesional_plan_arancel';

	protected $casts = [
		'profesional_plan_id' => 'int',
		'arancel_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'valor' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'profesional_plan_id',
		'arancel_id',
		'created_by',
		'modified_by',
		'valor',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function arancel_medico()
	{
		return $this->belongsTo(ArancelMedico::class, 'arancel_id');
	}

	public function profesional_plan()
	{
		return $this->belongsTo(ProfesionalPlan::class);
	}
}
