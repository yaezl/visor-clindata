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
 * Class AreaMotivoSaludmental
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descripcion
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * 
 * @property Collection|Saludmental[] $saludmentals
 *
 * @package App\Models
 */
class AreaMotivoSaludmental extends Model
{
	use SoftDeletes;
	protected $table = 'area_motivo_saludmental';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'codigo',
		'descripcion',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function saludmentals()
	{
		return $this->hasMany(Saludmental::class, 'area_motivo_id');
	}
}
