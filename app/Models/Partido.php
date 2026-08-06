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
 * Class Partido
 * 
 * @property int $id
 * @property int $provincia_id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * 
 * @property Provincium $provincium
 * @property Collection|Ciudad[] $ciudads
 * @property Collection|Direccion[] $direccions
 *
 * @package App\Models
 */
class Partido extends Model
{
	use SoftDeletes;
	protected $table = 'partido';

	protected $casts = [
		'provincia_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'provincia_id',
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo'
	];

	public function provincium()
	{
		return $this->belongsTo(Provincium::class, 'provincia_id');
	}

	public function ciudads()
	{
		return $this->hasMany(Ciudad::class);
	}

	public function direccions()
	{
		return $this->hasMany(Direccion::class);
	}
}
