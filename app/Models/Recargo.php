<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recargo
 * 
 * @property int $id
 * @property float $multiplicador
 * @property bool $borrado_logico
 * 
 * @property Collection|Bono[] $bonos
 * @property Collection|ReglaRecargoDium[] $regla_recargo_dia
 * @property Collection|ReglaRecargoOcasional[] $regla_recargo_ocasionals
 *
 * @package App\Models
 */
class Recargo extends Model
{
	protected $table = 'recargo';
	public $timestamps = false;

	protected $casts = [
		'multiplicador' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'multiplicador',
		'borrado_logico'
	];

	public function bonos()
	{
		return $this->hasMany(Bono::class);
	}

	public function regla_recargo_dia()
	{
		return $this->hasMany(ReglaRecargoDium::class);
	}

	public function regla_recargo_ocasionals()
	{
		return $this->hasMany(ReglaRecargoOcasional::class);
	}
}
