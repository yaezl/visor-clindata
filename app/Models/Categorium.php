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
 * Class Categorium
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * 
 * @property Nomenclable $nomenclable
 * @property Collection|ArancelCategorium[] $arancel_categoria
 * @property Collection|Asignacion[] $asignacions
 * @property Collection|Cotizacion[] $cotizacions
 *
 * @package App\Models
 */
class Categorium extends Model
{
	use SoftDeletes;
	protected $table = 'categoria';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo'
	];

	public function nomenclable()
	{
		return $this->belongsTo(Nomenclable::class, 'id');
	}

	public function arancel_categoria()
	{
		return $this->hasMany(ArancelCategorium::class, 'categoria_id');
	}

	public function asignacions()
	{
		return $this->hasMany(Asignacion::class, 'categoria_id');
	}

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class, 'categoria_id');
	}
}
