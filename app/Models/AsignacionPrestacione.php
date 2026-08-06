<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AsignacionPrestacione
 * 
 * @property int $asignacion_id
 * @property int $prestacion_id
 * 
 * @property Prestacion $prestacion
 * @property Asignacion $asignacion
 *
 * @package App\Models
 */
class AsignacionPrestacione extends Model
{
	protected $table = 'asignacion_prestaciones';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'asignacion_id' => 'int',
		'prestacion_id' => 'int'
	];

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function asignacion()
	{
		return $this->belongsTo(Asignacion::class);
	}
}
