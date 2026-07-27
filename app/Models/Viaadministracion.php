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
 * Class Viaadministracion
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
 * @property Collection|Articulocronico[] $articulocronicos
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 *
 * @package App\Models
 */
class Viaadministracion extends Model
{
	use SoftDeletes;
	protected $table = 'viaadministracion';

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

	public function articulocronicos()
	{
		return $this->hasMany(Articulocronico::class, 'via_administracion_id');
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'via_administracion_id');
	}
}
