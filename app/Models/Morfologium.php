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
 * Class Morfologium
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borradoLogico
 * 
 * @property Collection|MorfologiaDetalle[] $morfologia_detalles
 *
 * @package App\Models
 */
class Morfologium extends Model
{
	use SoftDeletes;
	protected $table = 'morfologia';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'borradoLogico'
	];

	public function morfologia_detalles()
	{
		return $this->hasMany(MorfologiaDetalle::class, 'morfologia_id');
	}
}
