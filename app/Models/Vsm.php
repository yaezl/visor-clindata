<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vsm
 * 
 * @property int $id
 * @property string $identificador
 * @property string $genero
 * @property string $apellido
 * @property string $seg_apellido
 * @property string $nombre
 * @property string $inicial
 * @property Carbon|null $fecha
 * @property int $altura_cm
 * @property int $peso_gr
 * @property int $indice_masa
 * @property int $indice_dolor
 * @property int $respiracion
 * @property int $sistolica
 * @property int $diastolica
 * @property int $MAP
 * @property int $PR
 * @property int $HR
 * @property float $temperatura
 * @property int $sat02
 *
 * @package App\Models
 */
class Vsm extends Model
{
	protected $table = 'vsm';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'altura_cm' => 'int',
		'peso_gr' => 'int',
		'indice_masa' => 'int',
		'indice_dolor' => 'int',
		'respiracion' => 'int',
		'sistolica' => 'int',
		'diastolica' => 'int',
		'MAP' => 'int',
		'PR' => 'int',
		'HR' => 'int',
		'temperatura' => 'float',
		'sat02' => 'int'
	];

	protected $fillable = [
		'identificador',
		'genero',
		'apellido',
		'seg_apellido',
		'nombre',
		'inicial',
		'fecha',
		'altura_cm',
		'peso_gr',
		'indice_masa',
		'indice_dolor',
		'respiracion',
		'sistolica',
		'diastolica',
		'MAP',
		'PR',
		'HR',
		'temperatura',
		'sat02'
	];
}
