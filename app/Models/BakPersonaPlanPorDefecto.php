<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BakPersonaPlanPorDefecto
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $persona_plan_id
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 *
 * @package App\Models
 */
class BakPersonaPlanPorDefecto extends Model
{
	use SoftDeletes;
	protected $table = 'bak_persona_plan_por_defecto';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'persona_id' => 'int',
		'persona_plan_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'id',
		'persona_id',
		'persona_plan_id',
		'created_by',
		'modified_by',
		'deleted_by'
	];
}
