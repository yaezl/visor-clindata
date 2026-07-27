<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReservaQuirofanoProfesional
 * 
 * @property int $id
 * @property int $reserva_quirofano_id
 * @property int $personal_id
 * @property int $rol_id
 * @property int $especialidad_id
 * @property bool $borradoLogico
 * 
 * @property Especialidad $especialidad
 * @property InternacionRol $internacion_rol
 * @property Personal $personal
 * @property ReservaQuirofano $reserva_quirofano
 *
 * @package App\Models
 */
class ReservaQuirofanoProfesional extends Model
{
	protected $table = 'reserva_quirofano_profesional';
	public $timestamps = false;

	protected $casts = [
		'reserva_quirofano_id' => 'int',
		'personal_id' => 'int',
		'rol_id' => 'int',
		'especialidad_id' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'reserva_quirofano_id',
		'personal_id',
		'rol_id',
		'especialidad_id',
		'borradoLogico'
	];

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function internacion_rol()
	{
		return $this->belongsTo(InternacionRol::class, 'rol_id');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class);
	}
}
