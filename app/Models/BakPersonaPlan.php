<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BakPersonaPlan
 * 
 * @property int $id
 * @property int $persona_id
 * @property int $plan_id
 * @property int $tipo_beneficiario_id
 * @property int $tipo_parentesco_id
 * @property string $nro_beneficiario
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 *
 * @package App\Models
 */
class BakPersonaPlan extends Model
{
	use SoftDeletes;
	protected $table = 'bak_persona_plan';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'persona_id' => 'int',
		'plan_id' => 'int',
		'tipo_beneficiario_id' => 'int',
		'tipo_parentesco_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'id',
		'persona_id',
		'plan_id',
		'tipo_beneficiario_id',
		'tipo_parentesco_id',
		'nro_beneficiario',
		'created_by',
		'modified_by',
		'deleted_by'
	];
}
