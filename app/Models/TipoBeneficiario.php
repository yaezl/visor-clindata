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
 * Class TipoBeneficiario
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * 
 * @property Collection|PersonaPlan[] $persona_plans
 * @property Collection|PersonaPlansocial[] $persona_plansocials
 *
 * @package App\Models
 */
class TipoBeneficiario extends Model
{
	use SoftDeletes;
	protected $table = 'tipo_beneficiario';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function persona_plans()
	{
		return $this->hasMany(PersonaPlan::class);
	}

	public function persona_plansocials()
	{
		return $this->hasMany(PersonaPlansocial::class);
	}
}
