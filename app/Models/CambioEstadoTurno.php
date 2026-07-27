<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CambioEstadoTurno
 * 
 * @property int $id
 * @property int $turno_id
 * @property int $estado_turno_id
 * @property int $modified_by
 * @property Carbon $fecha
 * @property string|null $extraData
 * @property bool $esUltimoRegistro
 * 
 * @property Usuario $usuario
 * @property TurnoProgramado $turno_programado
 * @property EstadoTurno $estado_turno
 *
 * @package App\Models
 */
class CambioEstadoTurno extends Model
{
	protected $table = 'cambio_estado_turno';
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'estado_turno_id' => 'int',
		'modified_by' => 'int',
		'fecha' => 'datetime',
		'esUltimoRegistro' => 'bool'
	];

	protected $fillable = [
		'turno_id',
		'estado_turno_id',
		'modified_by',
		'fecha',
		'extraData',
		'esUltimoRegistro'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modified_by');
	}

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}

	public function estado_turno()
	{
		return $this->belongsTo(EstadoTurno::class);
	}
}
