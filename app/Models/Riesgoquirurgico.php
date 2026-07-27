<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Riesgoquirurgico
 * 
 * @property int $id
 * @property string $fechalectura
 * @property string $tabaquismo
 * @property string $insuficienciarenal
 * @property string $diabetes
 * @property string $cf
 * @property string $arritmias
 * @property string $hta
 * @property string $ecaprevio
 * @property string $otros
 * @property string $angor
 * @property string $disnea
 * @property string $alergiamed
 * @property string $medhab
 * @property string $examenfisico
 * @property string $ta
 * @property string $riesgocirugiaalto
 * @property string $riesgocirugiaintermedio
 * @property string $riesgocirugiabajo
 * @property string $riesgocardiovascularalto
 * @property string $riesgocardiovascularintermedio
 * @property string $riesgocardiovascularbajo
 * @property string $habitual
 * @property string $moderado
 * @property string $alto
 * @property string $observaciones
 * @property string $diagnostico
 * @property Carbon $fechacreacion
 * @property Carbon $fechaeliminacion
 * @property int $idpaciente
 * @property int $idusuario
 * @property int $eliminado
 *
 * @package App\Models
 */
class Riesgoquirurgico extends Model
{
	protected $table = 'riesgoquirurgico';
	public $timestamps = false;

	protected $casts = [
		'fechacreacion' => 'datetime',
		'fechaeliminacion' => 'datetime',
		'idpaciente' => 'int',
		'idusuario' => 'int',
		'eliminado' => 'int'
	];

	protected $fillable = [
		'fechalectura',
		'tabaquismo',
		'insuficienciarenal',
		'diabetes',
		'cf',
		'arritmias',
		'hta',
		'ecaprevio',
		'otros',
		'angor',
		'disnea',
		'alergiamed',
		'medhab',
		'examenfisico',
		'ta',
		'riesgocirugiaalto',
		'riesgocirugiaintermedio',
		'riesgocirugiabajo',
		'riesgocardiovascularalto',
		'riesgocardiovascularintermedio',
		'riesgocardiovascularbajo',
		'habitual',
		'moderado',
		'alto',
		'observaciones',
		'diagnostico',
		'fechacreacion',
		'fechaeliminacion',
		'idpaciente',
		'idusuario',
		'eliminado'
	];
}
