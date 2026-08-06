<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HolterTipoEquipo
 * 
 * @property int $id
 * @property string $nombreTipoEquipo
 * @property int $creadoPor
 * @property int|null $modificadoPor
 * @property int|null $eliminadoPor
 * @property Carbon $fechaCreacion
 * @property Carbon|null $fechaModificacion
 * @property Carbon|null $fechaEliminacion
 *
 * @package App\Models
 */
class HolterTipoEquipo extends Model
{
	protected $table = 'holter_tipo_equipo';
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
		'nombreTipoEquipo',
		'creadoPor',
		'modificadoPor',
		'eliminadoPor',
		'fechaCreacion',
		'fechaModificacion',
		'fechaEliminacion'
	];
}
