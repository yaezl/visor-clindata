<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TurnoEstudio
 * 
 * @property int $id
 * @property int|null $turno_id
 * @property int|null $estudio_id
 * @property string|null $estado
 * @property string|null $estado_msg
 * @property bool $borrado_logico
 * @property string|null $url
 * @property int|null $cantidad
 * @property bool $guardadoDesdeConsulta
 * 
 * @property TurnoProgramado|null $turno_programado
 * @property Estudio|null $estudio
 *
 * @package App\Models
 */
class TurnoEstudio extends Model
{
	protected $table = 'turno_estudios';
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'estudio_id' => 'int',
		'borrado_logico' => 'bool',
		'cantidad' => 'int',
		'guardadoDesdeConsulta' => 'bool'
	];

	protected $fillable = [
		'turno_id',
		'estudio_id',
		'estado',
		'estado_msg',
		'borrado_logico',
		'url',
		'cantidad',
		'guardadoDesdeConsulta'
	];

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}
}
