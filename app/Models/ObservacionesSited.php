<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ObservacionesSited
 * 
 * @property int $id
 * @property string $observacionAsegurado
 * @property string $observacionEspecial
 * @property Carbon $createdAt
 * 
 * @property Collection|Sited[] $siteds
 *
 * @package App\Models
 */
class ObservacionesSited extends Model
{
	protected $table = 'ObservacionesSiteds';
	public $timestamps = false;

	protected $casts = [
		'createdAt' => 'datetime'
	];

	protected $fillable = [
		'observacionAsegurado',
		'observacionEspecial',
		'createdAt'
	];

	public function siteds()
	{
		return $this->hasMany(Sited::class, 'observacionId');
	}
}
