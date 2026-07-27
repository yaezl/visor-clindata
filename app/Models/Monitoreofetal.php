<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Monitoreofetal
 * 
 * @property int $id
 * @property string $medicosolicitante
 * @property int $edad
 * @property string $tamax
 * @property string $tamin
 * @property string $test
 * @property string $duracion
 * @property string $frecuencia
 * @property string $variabilidad
 * @property string $aceleraciones
 * @property string $desaceleraciones
 * @property string $movimientos
 * @property string $dinamica
 * @property string $tono
 * @property string $resultados
 * @property string $observaciones
 * @property string $eliminado
 * @property Carbon $fechacreacion
 * @property int $idusuario
 * @property int $idpaciente
 *
 * @package App\Models
 */
class Monitoreofetal extends Model
{
	protected $table = 'monitoreofetal';
	public $timestamps = false;

	protected $casts = [
		'edad' => 'int',
		'fechacreacion' => 'datetime',
		'idusuario' => 'int',
		'idpaciente' => 'int'
	];

	protected $fillable = [
		'medicosolicitante',
		'edad',
		'tamax',
		'tamin',
		'test',
		'duracion',
		'frecuencia',
		'variabilidad',
		'aceleraciones',
		'desaceleraciones',
		'movimientos',
		'dinamica',
		'tono',
		'resultados',
		'observaciones',
		'eliminado',
		'fechacreacion',
		'idusuario',
		'idpaciente'
	];
}
