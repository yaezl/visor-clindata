<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontologiabonoitemestado
 * 
 * @property int $id
 * @property int $id_bono_item
 * @property int $id_estado_odontologia
 * @property Carbon|null $fecha_realizacion
 * @property string $piezadental
 * @property string|null $observaciones
 * @property int $idUsuarioModifico
 *
 * @package App\Models
 */
class Odontologiabonoitemestado extends Model
{
	protected $table = 'odontologiabonoitemestado';
	public $timestamps = false;

	protected $casts = [
		'id_bono_item' => 'int',
		'id_estado_odontologia' => 'int',
		'fecha_realizacion' => 'datetime',
		'idUsuarioModifico' => 'int'
	];

	protected $fillable = [
		'id_bono_item',
		'id_estado_odontologia',
		'fecha_realizacion',
		'piezadental',
		'observaciones',
		'idUsuarioModifico'
	];
}
