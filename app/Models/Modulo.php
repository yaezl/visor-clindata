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
 * Class Modulo
 * 
 * @property int $id
 * @property string $nombre
 * @property string $nombre_sistema
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * 
 * @property Collection|Config[] $configs
 * @property Collection|Feature[] $features
 * @property Collection|Reporteconfig[] $reporteconfigs
 *
 * @package App\Models
 */
class Modulo extends Model
{
	use SoftDeletes;
	protected $table = 'modulo';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'nombre_sistema',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo'
	];

	public function configs()
	{
		return $this->hasMany(Config::class);
	}

	public function features()
	{
		return $this->hasMany(Feature::class);
	}

	public function reporteconfigs()
	{
		return $this->hasMany(Reporteconfig::class);
	}
}
