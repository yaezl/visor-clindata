<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Trabajosocial
 * 
 * @property int $id
 * @property string $ocupado
 * @property string $otrascategorias
 * @property string $programasocial
 * @property string $vivienda
 * @property string $necesidadesbasicas
 * @property string $alguienacargo
 * @property string $acargodealguien
 * @property string $nivelestudio
 * @property string $estadocivil
 * @property string $tipofamilia
 * @property string $otrosreferentes
 * @property string $evaluacionvulnerabilidad
 * @property string $tipoPresentacion
 * @property string $os
 * @property Carbon $fechaCreacion
 * @property int $idusuario
 * @property int $idpaciente
 * @property string $eliminado
 * @property Carbon|null $fechaEliminacion
 *
 * @package App\Models
 */
class Trabajosocial extends Model
{
	protected $table = 'trabajosocial';
	public $timestamps = false;

	protected $casts = [
		'fechaCreacion' => 'datetime',
		'idusuario' => 'int',
		'idpaciente' => 'int',
		'fechaEliminacion' => 'datetime'
	];

	protected $fillable = [
		'ocupado',
		'otrascategorias',
		'programasocial',
		'vivienda',
		'necesidadesbasicas',
		'alguienacargo',
		'acargodealguien',
		'nivelestudio',
		'estadocivil',
		'tipofamilia',
		'otrosreferentes',
		'evaluacionvulnerabilidad',
		'tipoPresentacion',
		'os',
		'fechaCreacion',
		'idusuario',
		'idpaciente',
		'eliminado',
		'fechaEliminacion'
	];
}
