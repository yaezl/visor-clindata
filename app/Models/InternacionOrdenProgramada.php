<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionOrdenProgramada
 * 
 * @property int $id
 * @property int|null $procedimiento_programado_id
 * @property int|null $hora_programada_id
 * @property Carbon $fecha_programada
 * @property int|null $recepcionado_por
 * @property int|null $autorizado_por
 * @property Carbon|null $recepcionado
 * @property Carbon|null $paciente_autorizado
 * 
 * @property InternacionProcedimiento|null $internacion_procedimiento
 * @property Usuario|null $usuario
 * @property InternacionHoraProgramada|null $internacion_hora_programada
 * @property InternacionOrden $internacion_orden
 *
 * @package App\Models
 */
class InternacionOrdenProgramada extends Model
{
	protected $table = 'internacion_orden_programada';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'procedimiento_programado_id' => 'int',
		'hora_programada_id' => 'int',
		'fecha_programada' => 'datetime',
		'recepcionado_por' => 'int',
		'autorizado_por' => 'int',
		'recepcionado' => 'datetime',
		'paciente_autorizado' => 'datetime'
	];

	protected $fillable = [
		'procedimiento_programado_id',
		'hora_programada_id',
		'fecha_programada',
		'recepcionado_por',
		'autorizado_por',
		'recepcionado',
		'paciente_autorizado'
	];

	public function internacion_procedimiento()
	{
		return $this->belongsTo(InternacionProcedimiento::class, 'procedimiento_programado_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'recepcionado_por');
	}

	public function internacion_hora_programada()
	{
		return $this->belongsTo(InternacionHoraProgramada::class, 'hora_programada_id');
	}

	public function internacion_orden()
	{
		return $this->belongsTo(InternacionOrden::class, 'id');
	}
}
