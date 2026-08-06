<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoAuditoriaTimer
 * 
 * @property int $id
 * @property int $usuario_id
 * @property Carbon $fecha_hora
 * 
 * @property Usuario $usuario
 * @property Collection|InternacionQuirofanoAuditoriaEnfermerium[] $internacion_quirofano_auditoria_enfermeria
 * @property Collection|InternacionQuirofanoAuditoriaLimpieza[] $internacion_quirofano_auditoria_limpiezas
 * @property Collection|InternacionQuirofanoAuditoriaQuirofano[] $internacion_quirofano_auditoria_quirofanos
 * @property Collection|InternacionQuirofanoAuditoriaRecepcion[] $internacion_quirofano_auditoria_recepcions
 * @property Collection|InternacionQuirofanoAuditoriaRecuperacion[] $internacion_quirofano_auditoria_recuperacions
 *
 * @package App\Models
 */
class InternacionQuirofanoAuditoriaTimer extends Model
{
	protected $table = 'internacion_quirofano_auditoria_timers';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'fecha_hora' => 'datetime'
	];

	protected $fillable = [
		'usuario_id',
		'fecha_hora'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function internacion_quirofano_auditoria_enfermeria()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaEnfermerium::class, 'ingreso_id');
	}

	public function internacion_quirofano_auditoria_limpiezas()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaLimpieza::class, 'fin_id');
	}

	public function internacion_quirofano_auditoria_quirofanos()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaQuirofano::class, 'ingreso_id');
	}

	public function internacion_quirofano_auditoria_recepcions()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaRecepcion::class, 'planta_baja');
	}

	public function internacion_quirofano_auditoria_recuperacions()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaRecuperacion::class, 'ingreso_id');
	}
}
