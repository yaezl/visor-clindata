<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pap
 * 
 * @property int $id
 * @property string|null $nroProtocolo
 * @property string|null $estadoEspecimen
 * @property string|null $celPavimentosa
 * @property string|null $celCilindricas
 * @property string|null $evHormonal
 * @property string|null $resultado
 * @property Carbon|null $fechaLectura
 * @property string|null $valorHormonal
 * @property string|null $valorHormonalHC
 * @property string|null $cambioReactivo
 * @property string|null $cambioCelPavimentosa
 * @property string|null $anomaliaCelGlandulares
 * @property string|null $celMetaplasica
 * @property string|null $otraNeoMaligna
 * @property string|null $recomendaciones
 * @property string|null $toma
 * @property string|null $microorganismos
 * @property string|null $anomaliaCelEscamosa
 * @property string|null $observaciones
 * @property string $medicosolicitante
 * @property Carbon $fechaCreacion
 * @property Carbon|null $fechaeliminacion
 * @property int $idPaciente
 * @property int $idUsuario
 * @property int $estado
 * @property string|null $realizadopor
 * @property string|null $matricula
 *
 * @package App\Models
 */
class Pap extends Model
{
	protected $table = 'pap';
	public $timestamps = false;

	protected $casts = [
		'fechaLectura' => 'datetime',
		'fechaCreacion' => 'datetime',
		'fechaeliminacion' => 'datetime',
		'idPaciente' => 'int',
		'idUsuario' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'nroProtocolo',
		'estadoEspecimen',
		'celPavimentosa',
		'celCilindricas',
		'evHormonal',
		'resultado',
		'fechaLectura',
		'valorHormonal',
		'valorHormonalHC',
		'cambioReactivo',
		'cambioCelPavimentosa',
		'anomaliaCelGlandulares',
		'celMetaplasica',
		'otraNeoMaligna',
		'recomendaciones',
		'toma',
		'microorganismos',
		'anomaliaCelEscamosa',
		'observaciones',
		'medicosolicitante',
		'fechaCreacion',
		'fechaeliminacion',
		'idPaciente',
		'idUsuario',
		'estado',
		'realizadopor',
		'matricula'
	];
}
