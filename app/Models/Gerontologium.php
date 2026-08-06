<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gerontologium
 * 
 * @property int $id
 * @property string $fijo
 * @property string $celular
 * @property string $escolaridad
 * @property string $ocupacionactual
 * @property string $lateridad
 * @property string $estadocivil
 * @property string $numerohijos
 * @property string $nucleoconviviente
 * @property string $vision
 * @property string $audicion
 * @property string $olfacion
 * @property string $gusto
 * @property string $alteraciones
 * @property string $dentadura
 * @property string $trastornosdeglutorios
 * @property string $alimentacion
 * @property string $esfinteres
 * @property string $polifarmacia
 * @property string $marcha
 * @property string $dolor
 * @property string $insomnio
 * @property string $mini
 * @property string $bmi
 * @property string $circbra
 * @property string $circpant
 * @property string $indiceka
 * @property string $esc_12
 * @property string $esc_16
 * @property string $esc_28
 * @property string $escala
 * @property string $famili
 * @property string $sociofamili
 * @property string $moca
 * @property string $adas
 * @property string $ace
 * @property string $informe
 * @property int $usuario_id
 * @property int $paciente_id
 * @property Carbon $fechacreacion
 * @property Carbon $fechamodificacion
 * @property int $usuariochange
 * @property Carbon $fechaeliminacion
 * @property int $eliminado
 *
 * @package App\Models
 */
class Gerontologium extends Model
{
	protected $table = 'gerontologia';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'paciente_id' => 'int',
		'fechacreacion' => 'datetime',
		'fechamodificacion' => 'datetime',
		'usuariochange' => 'int',
		'fechaeliminacion' => 'datetime',
		'eliminado' => 'int'
	];

	protected $fillable = [
		'fijo',
		'celular',
		'escolaridad',
		'ocupacionactual',
		'lateridad',
		'estadocivil',
		'numerohijos',
		'nucleoconviviente',
		'vision',
		'audicion',
		'olfacion',
		'gusto',
		'alteraciones',
		'dentadura',
		'trastornosdeglutorios',
		'alimentacion',
		'esfinteres',
		'polifarmacia',
		'marcha',
		'dolor',
		'insomnio',
		'mini',
		'bmi',
		'circbra',
		'circpant',
		'indiceka',
		'esc_12',
		'esc_16',
		'esc_28',
		'escala',
		'famili',
		'sociofamili',
		'moca',
		'adas',
		'ace',
		'informe',
		'usuario_id',
		'paciente_id',
		'fechacreacion',
		'fechamodificacion',
		'usuariochange',
		'fechaeliminacion',
		'eliminado'
	];
}
