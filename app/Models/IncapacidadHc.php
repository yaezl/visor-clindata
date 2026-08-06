<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IncapacidadHc
 * 
 * @property int $id
 * @property Carbon $fechaInicio
 * @property Carbon $fechaFin
 * @property int $duracionDias
 * @property string $descripcion
 * @property bool $esProrrogable
 * @property int|null $tipo_incapacidad_id
 * @property string|null $numeroFolio
 * 
 * @property TipoIncapacidad|null $tipo_incapacidad
 * @property Collection|Consultadetalle[] $consultadetalles
 *
 * @package App\Models
 */
class IncapacidadHc extends Model
{
	protected $table = 'incapacidad_hc';
	public $timestamps = false;

	protected $casts = [
		'fechaInicio' => 'datetime',
		'fechaFin' => 'datetime',
		'duracionDias' => 'int',
		'esProrrogable' => 'bool',
		'tipo_incapacidad_id' => 'int'
	];

	protected $fillable = [
		'fechaInicio',
		'fechaFin',
		'duracionDias',
		'descripcion',
		'esProrrogable',
		'tipo_incapacidad_id',
		'numeroFolio'
	];

	public function tipo_incapacidad()
	{
		return $this->belongsTo(TipoIncapacidad::class);
	}

	public function consultadetalles()
	{
		return $this->hasMany(Consultadetalle::class, 'incapacidad_id');
	}
}
