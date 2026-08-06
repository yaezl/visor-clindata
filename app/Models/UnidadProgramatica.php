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
 * Class UnidadProgramatica
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $observaciones
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $activo
 * 
 * @property Collection|Institucion[] $institucions
 *
 * @package App\Models
 */
class UnidadProgramatica extends Model
{
	use SoftDeletes;
	protected $table = 'unidad_programatica';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'observaciones',
		'created_by',
		'modified_by',
		'deleted_by',
		'activo'
	];

	public function institucions()
	{
		return $this->belongsToMany(Institucion::class, 'unidad_programatica_instituciones');
	}
}
