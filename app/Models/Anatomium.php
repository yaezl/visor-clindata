<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Anatomium
 * 
 * @property int $id
 * @property string $nroinforme
 * @property string $materialremitido
 * @property string $tecnica
 * @property string $macroscopia
 * @property string $microscopia
 * @property string $diagnostico
 * @property string|null $codigoscie
 * @property string $nota
 * @property Carbon $fechalectura
 * @property string $medicosolicitante
 * @property string $tumor
 * @property Carbon $fechacreacion
 * @property int $eliminado
 * @property int $idusuario
 * @property int $idpaciente
 * @property string|null $observacion
 *
 * @package App\Models
 */
class Anatomium extends Model
{
	protected $table = 'anatomia';
	public $timestamps = false;

	protected $casts = [
		'fechalectura' => 'datetime',
		'fechacreacion' => 'datetime',
		'eliminado' => 'int',
		'idusuario' => 'int',
		'idpaciente' => 'int'
	];

	protected $fillable = [
		'nroinforme',
		'materialremitido',
		'tecnica',
		'macroscopia',
		'microscopia',
		'diagnostico',
		'codigoscie',
		'nota',
		'fechalectura',
		'medicosolicitante',
		'tumor',
		'fechacreacion',
		'eliminado',
		'idusuario',
		'idpaciente',
		'observacion'
	];
}
