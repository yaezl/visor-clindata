<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarSolicitudTurno
 * 
 * @property int $id
 * @property int|null $turno_id
 * @property int $cantidad
 * 
 * @property AdminTurnoEnfermerium|null $admin_turno_enfermerium
 * @property Collection|FarDetalleSolicitudTurno[] $far_detalle_solicitud_turnos
 *
 * @package App\Models
 */
class FarSolicitudTurno extends Model
{
	protected $table = 'far_solicitud_turno';
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'turno_id',
		'cantidad'
	];

	public function admin_turno_enfermerium()
	{
		return $this->belongsTo(AdminTurnoEnfermerium::class, 'turno_id');
	}

	public function far_detalle_solicitud_turnos()
	{
		return $this->hasMany(FarDetalleSolicitudTurno::class, 'solicitud_turno_id');
	}
}
