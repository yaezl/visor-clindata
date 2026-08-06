<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoAuditoriaQuirofano
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int|null $motivo_demora
 * @property int $reserva_id
 * @property int|null $ingreso_id
 * @property int|null $egreso_id
 * @property int|null $induccion_id
 * @property int|null $incision_id
 * @property int|null $cierre_id
 * @property string $observacion
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * @property bool $recuentoGasas
 * @property string $recuentoInstrumental
 * @property string $materialAnatomiaPatologica
 * @property string $materialCultivo
 * @property string $antibiotico
 * @property Carbon|null $hora_antibiotico
 * 
 * @property Usuario $usuario
 * @property InternacionQuirofanoAuditoriaTimer|null $internacion_quirofano_auditoria_timer
 * @property InternacionQuirofanoMotivoDemoraQuirofano|null $internacion_quirofano_motivo_demora_quirofano
 * @property ReservaQuirofano $reserva_quirofano
 *
 * @package App\Models
 */
class InternacionQuirofanoAuditoriaQuirofano extends Model
{
	protected $table = 'internacion_quirofano_auditoria_quirofano';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'motivo_demora' => 'int',
		'reserva_id' => 'int',
		'ingreso_id' => 'int',
		'egreso_id' => 'int',
		'induccion_id' => 'int',
		'incision_id' => 'int',
		'cierre_id' => 'int',
		'borradoLogico' => 'bool',
		'recuentoGasas' => 'bool',
		'hora_antibiotico' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'motivo_demora',
		'reserva_id',
		'ingreso_id',
		'egreso_id',
		'induccion_id',
		'incision_id',
		'cierre_id',
		'observacion',
		'borradoLogico',
		'recuentoGasas',
		'recuentoInstrumental',
		'materialAnatomiaPatologica',
		'materialCultivo',
		'antibiotico',
		'hora_antibiotico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_timer()
	{
		return $this->belongsTo(InternacionQuirofanoAuditoriaTimer::class, 'ingreso_id');
	}

	public function internacion_quirofano_motivo_demora_quirofano()
	{
		return $this->belongsTo(InternacionQuirofanoMotivoDemoraQuirofano::class, 'motivo_demora');
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class, 'reserva_id');
	}
}
