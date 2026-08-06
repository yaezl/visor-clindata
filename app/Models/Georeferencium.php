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
 * Class Georeferencium
 * 
 * @property int $id
 * @property float $latitud
 * @property float $longitud
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * 
 * @property Collection|Direccion[] $direccions
 *
 * @package App\Models
 */
class Georeferencium extends Model
{
	use SoftDeletes;
	protected $table = 'georeferencia';

	protected $casts = [
		'latitud' => 'float',
		'longitud' => 'float',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'latitud',
		'longitud',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function direccions()
	{
		return $this->hasMany(Direccion::class, 'georeferencia_id');
	}
}
