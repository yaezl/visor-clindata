<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tumor
 * 
 * @property int $id
 * @property string|null $lateralidad
 * @property string|null $numeroprotocolo
 * @property string|null $patologo
 * @property int|null $cantidad
 * @property string|null $diagnosticohistologico
 * @property string|null $primario
 * @property string|null $estadio
 * @property string|null $tnm
 * @property string|null $tnmq
 * @property string|null $localizacion
 * @property string|null $diagnosticoespecifico
 * @property int|null $idusuario
 * @property int|null $idpaciente
 * @property string|null $profesional
 * @property string|null $matriculaprofesional
 * @property Carbon|null $fechadiagnostico
 * @property int $eliminado
 *
 * @package App\Models
 */
class Tumor extends Model
{
	protected $table = 'tumor';
	public $timestamps = false;

	protected $casts = [
		'cantidad' => 'int',
		'idusuario' => 'int',
		'idpaciente' => 'int',
		'fechadiagnostico' => 'datetime',
		'eliminado' => 'int'
	];

	protected $fillable = [
		'lateralidad',
		'numeroprotocolo',
		'patologo',
		'cantidad',
		'diagnosticohistologico',
		'primario',
		'estadio',
		'tnm',
		'tnmq',
		'localizacion',
		'diagnosticoespecifico',
		'idusuario',
		'idpaciente',
		'profesional',
		'matriculaprofesional',
		'fechadiagnostico',
		'eliminado'
	];
}
