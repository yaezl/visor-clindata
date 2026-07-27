<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CoberturaSited
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombreCobertura
 * @property int $tipo
 * @property int $subTipo
 * @property int $copagoFijo
 * @property int $copagoVariable
 * @property string|null $finCarencia
 * @property string|null $observacion
 * @property string|null $observacionPEspera
 * @property string|null $observacionPCarencia
 * @property string|null $observacionPLatencia
 * @property string|null $condicionEspecial
 * @property bool $esDescuentoPorPlanilla
 * @property Carbon $createdAt
 * 
 * @property Collection|RestriccionesCobertura[] $restricciones_coberturas
 * @property Collection|Sited[] $siteds
 *
 * @package App\Models
 */
class CoberturaSited extends Model
{
	protected $table = 'CoberturaSiteds';
	public $timestamps = false;

	protected $casts = [
		'tipo' => 'int',
		'subTipo' => 'int',
		'copagoFijo' => 'int',
		'copagoVariable' => 'int',
		'esDescuentoPorPlanilla' => 'bool',
		'createdAt' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'nombreCobertura',
		'tipo',
		'subTipo',
		'copagoFijo',
		'copagoVariable',
		'finCarencia',
		'observacion',
		'observacionPEspera',
		'observacionPCarencia',
		'observacionPLatencia',
		'condicionEspecial',
		'esDescuentoPorPlanilla',
		'createdAt'
	];

	public function restricciones_coberturas()
	{
		return $this->hasMany(RestriccionesCobertura::class, 'coberturaId');
	}

	public function siteds()
	{
		return $this->hasMany(Sited::class, 'coberturaId');
	}
}
