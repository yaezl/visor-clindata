<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cardiologium
 * 
 * @property int $id
 * @property string $medicosolicitante
 * @property Carbon $fechalectura
 * @property string $motivo
 * @property string $ritmo
 * @property string $frecuencia
 * @property string $eje
 * @property string $posicion
 * @property string $pr
 * @property string $qrs
 * @property string $qt
 * @property string $qtc
 * @property string $conclusiones
 * @property Carbon $fechacreacion
 * @property Carbon $fechaeliminacion
 * @property int $idpaciente
 * @property int $idusuario
 * @property int $eliminado
 *
 * @package App\Models
 */
class Cardiologium extends Model
{
	protected $table = 'cardiologia';
	public $timestamps = false;

	protected $casts = [
		'fechalectura' => 'datetime',
		'fechacreacion' => 'datetime',
		'fechaeliminacion' => 'datetime',
		'idpaciente' => 'int',
		'idusuario' => 'int',
		'eliminado' => 'int'
	];

	protected $fillable = [
		'medicosolicitante',
		'fechalectura',
		'motivo',
		'ritmo',
		'frecuencia',
		'eje',
		'posicion',
		'pr',
		'qrs',
		'qt',
		'qtc',
		'conclusiones',
		'fechacreacion',
		'fechaeliminacion',
		'idpaciente',
		'idusuario',
		'eliminado'
	];
}
