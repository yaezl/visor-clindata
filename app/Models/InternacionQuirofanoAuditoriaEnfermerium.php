<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoAuditoriaEnfermerium
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $reserva_id
 * @property int|null $motivo_demora_id
 * @property int|null $box_enfermeria_id
 * @property int|null $ingreso_id
 * @property int|null $egreso_id
 * @property int|null $paciente_ok_id
 * @property int|null $minDemora
 * @property string $observacion
 * @property string $tipo
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property InternacionQuirofanoAuditoriaTimer|null $internacion_quirofano_auditoria_timer
 * @property InternacionQuirofanoBoxEnfermerium|null $internacion_quirofano_box_enfermerium
 * @property ReservaQuirofano $reserva_quirofano
 * @property InternacionQuirofanoMotivoDemora|null $internacion_quirofano_motivo_demora
 *
 * @package App\Models
 */
class InternacionQuirofanoAuditoriaEnfermerium extends Model
{
	protected $table = 'internacion_quirofano_auditoria_enfermeria';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'reserva_id' => 'int',
		'motivo_demora_id' => 'int',
		'box_enfermeria_id' => 'int',
		'ingreso_id' => 'int',
		'egreso_id' => 'int',
		'paciente_ok_id' => 'int',
		'minDemora' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'reserva_id',
		'motivo_demora_id',
		'box_enfermeria_id',
		'ingreso_id',
		'egreso_id',
		'paciente_ok_id',
		'minDemora',
		'observacion',
		'tipo',
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

	public function internacion_quirofano_box_enfermerium()
	{
		return $this->belongsTo(InternacionQuirofanoBoxEnfermerium::class, 'box_enfermeria_id');
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class, 'reserva_id');
	}

	public function internacion_quirofano_motivo_demora()
	{
		return $this->belongsTo(InternacionQuirofanoMotivoDemora::class, 'motivo_demora_id');
	}
}
