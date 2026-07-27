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
 * Class Ciudad
 * 
 * @property int $id
 * @property int|null $provincia_id
 * @property string $nombre
 * @property string|null $codigo_postal
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo_ciudad
 * @property string $region_sanitaria
 * @property int|null $partido_id
 * 
 * @property Partido|null $partido
 * @property Provincium|null $provincium
 * @property Collection|Barrio[] $barrios
 * @property Collection|CiudadRegla[] $ciudad_reglas
 * @property Collection|Direccion[] $direccions
 *
 * @package App\Models
 */
class Ciudad extends Model
{
	use SoftDeletes;
	protected $table = 'ciudad';

	protected $casts = [
		'provincia_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'partido_id' => 'int'
	];

	protected $fillable = [
		'provincia_id',
		'nombre',
		'codigo_postal',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo_ciudad',
		'region_sanitaria',
		'partido_id'
	];

	public function partido()
	{
		return $this->belongsTo(Partido::class);
	}

	public function provincium()
	{
		return $this->belongsTo(Provincium::class, 'provincia_id');
	}

	public function barrios()
	{
		return $this->hasMany(Barrio::class);
	}

	public function ciudad_reglas()
	{
		return $this->hasMany(CiudadRegla::class);
	}

	public function direccions()
	{
		return $this->hasMany(Direccion::class);
	}
}
