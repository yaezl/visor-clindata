<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonaPlanPorDefecto
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
 * @property Usuario $usuario
 * @property Persona|null $persona
 * @property PersonaPlan|null $persona_plan
 *
 * @package App\Models
 */
class PersonaPlanPorDefecto extends Model
{
	use SoftDeletes;
	protected $table = 'persona_plan_por_defecto';

	protected $casts = [
		'persona_id' => 'int',
		'persona_plan_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'persona_plan_id',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function persona_plan()
	{
		return $this->belongsTo(PersonaPlan::class);
	}
}
