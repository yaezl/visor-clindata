<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HolterEquipo
 * 
 * @property int $id
 * @property string $nroEquipo
 * @property int $idTipoEquipo
 * @property int $creadoPor
 * @property int|null $modificadoPor
 * @property int|null $eliminadoPor
 * @property Carbon $fechaCreacion
 * @property Carbon|null $fechaModificacion
 * @property Carbon|null $fechaEliminacion
 *
 * @package App\Models
 */
class HolterEquipo extends Model
{
	protected $table = 'holter_equipo';
	public $timestamps = false;

	protected $casts = [
		'idTipoEquipo' => 'int',
		'creadoPor' => 'int',
		'modificadoPor' => 'int',
		'eliminadoPor' => 'int',
		'fechaCreacion' => 'datetime',
		'fechaModificacion' => 'datetime',
		'fechaEliminacion' => 'datetime'
	];

	protected $fillable = [
		'nroEquipo',
		'idTipoEquipo',
		'creadoPor',
		'modificadoPor',
		'eliminadoPor',
		'fechaCreacion',
		'fechaModificacion',
		'fechaEliminacion'
	];
}
