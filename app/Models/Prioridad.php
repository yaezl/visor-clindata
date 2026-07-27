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
 * Class Prioridad
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
 * @property Collection|TurnoGuardium[] $turno_guardia
 *
 * @package App\Models
 */
class Prioridad extends Model
{
	use SoftDeletes;
	protected $table = 'prioridad';

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

	public function turno_guardia()
	{
		return $this->hasMany(TurnoGuardium::class);
	}
}
