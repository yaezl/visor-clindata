<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cirugium
 * 
 * @property int $id
 * @property string $obrasocial
 * @property Carbon $fechaingreso
 * @property string $cirujano
 * @property string $ayudante1
 * @property string $ayudante2
 * @property string $anestesista
 * @property string $intrumentista
 * @property string $preoperatorio
 * @property string $postoperatorio
 * @property string $operacion
 * @property string $procedimiento
 * @property string $evolucion
 * @property string $epicrisis
 * @property string $condicion
 * @property string $alta
 * @property string $enviado
 * @property string $observaciones
 * @property string|null $eliminado
 * @property Carbon $fechacreacion
 * @property int $idusuario
 * @property int $idpaciente
 *
 * @package App\Models
 */
class Cirugium extends Model
{
	protected $table = 'cirugia';
	public $timestamps = false;

	protected $casts = [
		'fechaingreso' => 'datetime',
		'fechacreacion' => 'datetime',
		'idusuario' => 'int',
		'idpaciente' => 'int'
	];

	protected $fillable = [
		'obrasocial',
		'fechaingreso',
		'cirujano',
		'ayudante1',
		'ayudante2',
		'anestesista',
		'intrumentista',
		'preoperatorio',
		'postoperatorio',
		'operacion',
		'procedimiento',
		'evolucion',
		'epicrisis',
		'condicion',
		'alta',
		'enviado',
		'observaciones',
		'eliminado',
		'fechacreacion',
		'idusuario',
		'idpaciente'
	];
}
