<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Colposcopium
 * 
 * @property float $id
 * @property string|null $cuello
 * @property string|null $toma
 * @property string|null $hallazgos
 * @property string|null $indicadorDeCambios
 * @property string|null $insatisfactoria
 * @property string|null $tamanioCN
 * @property string|null $hallazgosPatologicos
 * @property string|null $lugol
 * @property string|null $diagnosticoCuello
 * @property string|null $diagnosticoVagina
 * @property string|null $diagnosticoVulva
 * @property string|null $observaciones
 * @property string|null $oe
 * @property string|null $miscelaneos
 * @property string|null $medicosolicitante
 * @property Carbon|null $fechaCreacion
 * @property Carbon|null $fechaModificacion
 * @property int $idPaciente
 * @property int $idUsuario
 * @property int $estado
 *
 * @package App\Models
 */
class Colposcopium extends Model
{
	protected $table = 'colposcopia';
	public $timestamps = false;

	protected $casts = [
		'fechaCreacion' => 'datetime',
		'fechaModificacion' => 'datetime',
		'idPaciente' => 'int',
		'idUsuario' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'cuello',
		'toma',
		'hallazgos',
		'indicadorDeCambios',
		'insatisfactoria',
		'tamanioCN',
		'hallazgosPatologicos',
		'lugol',
		'diagnosticoCuello',
		'diagnosticoVagina',
		'diagnosticoVulva',
		'observaciones',
		'oe',
		'miscelaneos',
		'medicosolicitante',
		'fechaCreacion',
		'fechaModificacion',
		'idPaciente',
		'idUsuario',
		'estado'
	];
}
