<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoAuditoriaRecuperacion
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $reserva_id
 * @property int|null $cama_destino_id
 * @property int|null $ingreso_id
 * @property int|null $egreso_id
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property InternacionQuirofanoAuditoriaTimer|null $internacion_quirofano_auditoria_timer
 * @property InternacionQuirofanoCamaDestinoRecuperacion|null $internacion_quirofano_cama_destino_recuperacion
 * @property ReservaQuirofano $reserva_quirofano
 *
 * @package App\Models
 */
class InternacionQuirofanoAuditoriaRecuperacion extends Model
{
	protected $table = 'internacion_quirofano_auditoria_recuperacion';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'reserva_id' => 'int',
		'cama_destino_id' => 'int',
		'ingreso_id' => 'int',
		'egreso_id' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'reserva_id',
		'cama_destino_id',
		'ingreso_id',
		'egreso_id',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_timer()
	{
		return $this->belongsTo(InternacionQuirofanoAuditoriaTimer::class, 'ingreso_id');
	}

	public function internacion_quirofano_cama_destino_recuperacion()
	{
		return $this->belongsTo(InternacionQuirofanoCamaDestinoRecuperacion::class, 'cama_destino_id');
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class, 'reserva_id');
	}
}
