<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoAuditoriaRecepcion
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $reserva_id
 * @property int|null $planta_baja
 * @property int|null $primer_piso
 * @property int $demora_ayuno
 * @property string|null $observacion
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borrado_logico
 * @property bool $tiene_ayuno
 * 
 * @property Usuario $usuario
 * @property InternacionQuirofanoAuditoriaTimer|null $internacion_quirofano_auditoria_timer
 * @property ReservaQuirofano $reserva_quirofano
 *
 * @package App\Models
 */
class InternacionQuirofanoAuditoriaRecepcion extends Model
{
	protected $table = 'internacion_quirofano_auditoria_recepcion';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'reserva_id' => 'int',
		'planta_baja' => 'int',
		'primer_piso' => 'int',
		'demora_ayuno' => 'int',
		'borrado_logico' => 'bool',
		'tiene_ayuno' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'reserva_id',
		'planta_baja',
		'primer_piso',
		'demora_ayuno',
		'observacion',
		'borrado_logico',
		'tiene_ayuno'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_timer()
	{
		return $this->belongsTo(InternacionQuirofanoAuditoriaTimer::class, 'planta_baja');
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class, 'reserva_id');
	}
}
