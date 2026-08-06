<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HolterTipoEstudio
 * 
 * @property int $id
 * @property string $nombreTipoEstudio
 * @property int $creadoPor
 * @property int $modificadoPor
 * @property int $eliminadoPor
 * @property Carbon $fechaCreacion
 * @property Carbon $fechaModificacion
 * @property Carbon $fechaEliminacion
 *
 * @package App\Models
 */
class HolterTipoEstudio extends Model
{
	protected $table = 'holter_tipo_estudio';
	public $timestamps = false;

	protected $casts = [
		'creadoPor' => 'int',
		'modificadoPor' => 'int',
		'eliminadoPor' => 'int',
		'fechaCreacion' => 'datetime',
		'fechaModificacion' => 'datetime',
		'fechaEliminacion' => 'datetime'
	];

	protected $fillable = [
		'nombreTipoEstudio',
		'creadoPor',
		'modificadoPor',
		'eliminadoPor',
		'fechaCreacion',
		'fechaModificacion',
		'fechaEliminacion'
	];
}
