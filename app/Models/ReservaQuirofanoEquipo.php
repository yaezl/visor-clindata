<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReservaQuirofanoEquipo
 * 
 * @property int $reserva_id
 * @property int $equipo_id
 * 
 * @property InternacionQuirofanoEquipo $internacion_quirofano_equipo
 * @property ReservaQuirofano $reserva_quirofano
 *
 * @package App\Models
 */
class ReservaQuirofanoEquipo extends Model
{
	protected $table = 'reserva_quirofano_equipo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'reserva_id' => 'int',
		'equipo_id' => 'int'
	];

	public function internacion_quirofano_equipo()
	{
		return $this->belongsTo(InternacionQuirofanoEquipo::class, 'equipo_id');
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class, 'reserva_id');
	}
}
