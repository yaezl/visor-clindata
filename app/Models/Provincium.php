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
 * Class Provincium
 * 
 * @property int $id
 * @property int $pais_id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * 
 * @property Pai $pai
 * @property Collection|Ciudad[] $ciudads
 * @property Collection|Direccion[] $direccions
 * @property Collection|Partido[] $partidos
 *
 * @package App\Models
 */
class Provincium extends Model
{
	use SoftDeletes;
	protected $table = 'provincia';

	protected $casts = [
		'pais_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'pais_id',
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo'
	];

	public function pai()
	{
		return $this->belongsTo(Pai::class, 'pais_id');
	}

	public function ciudads()
	{
		return $this->hasMany(Ciudad::class, 'provincia_id');
	}

	public function direccions()
	{
		return $this->hasMany(Direccion::class, 'provincia_id');
	}

	public function partidos()
	{
		return $this->hasMany(Partido::class, 'provincia_id');
	}
}
