<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Regla
 * 
 * @property int $id
 * @property int|null $nomenclador_id
 * @property int|null $nomenclable_id
 * @property bool $activo
 * 
 * @property Nomenclador|null $nomenclador
 * @property Nomenclable|null $nomenclable
 * @property Collection|Atributo[] $atributos
 *
 * @package App\Models
 */
class Regla extends Model
{
	protected $table = 'regla';
	public $timestamps = false;

	protected $casts = [
		'nomenclador_id' => 'int',
		'nomenclable_id' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'nomenclador_id',
		'nomenclable_id',
		'activo'
	];

	public function nomenclador()
	{
		return $this->belongsTo(Nomenclador::class);
	}

	public function nomenclable()
	{
		return $this->belongsTo(Nomenclable::class);
	}

	public function atributos()
	{
		return $this->hasMany(Atributo::class);
	}
}
