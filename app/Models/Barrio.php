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
 * Class Barrio
 * 
 * @property int $id
 * @property int $ciudad_id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigoPostal
 * 
 * @property Ciudad $ciudad
 * @property Collection|Direccion[] $direccions
 *
 * @package App\Models
 */
class Barrio extends Model
{
	use SoftDeletes;
	protected $table = 'barrio';

	protected $casts = [
		'ciudad_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'ciudad_id',
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigoPostal'
	];

	public function ciudad()
	{
		return $this->belongsTo(Ciudad::class);
	}

	public function direccions()
	{
		return $this->hasMany(Direccion::class);
	}
}
