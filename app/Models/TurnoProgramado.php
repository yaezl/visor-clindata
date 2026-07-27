<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TurnoProgramado
 * 
 * @property int $id
 * @property int $agenda_id
 * @property int|null $persona_id
 * @property int|null $plan_id
 * @property int $estado_turno_id
 * @property int $orden
 * @property Carbon $fecha
 * @property Carbon $hora
 * @property bool $sobreturno
 * @property int|null $fk_encuentro
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $consulta_id
 * @property int|null $institucion_id
 * @property string|null $observacion
 * @property int $tipovezqueconsulta
 * @property Carbon|null $fechahora_arribo
 * @property Carbon|null $fechahora_noasistio
 * @property int|null $usuarioarribo_id
 * @property int|null $usuarionoasistio_id
 * @property int|null $usuarioultimollamado_id
 * @property Carbon|null $fechahora_ultimollamado
 * @property bool $por_callcenter
 * @property string|null $estado_msg
 * @property bool $confirmado_por_paciente
 * @property int|null $criterio
 * @property bool $turno_portal_condicional
 * @property int|null $turno_origen_id
 * @property int|null $motivo_turno_id
 * @property int|null $cancelacion_origen_id
 * @property int|null $persona_usuario_portal_id
 * @property string|null $codigo_ad_hoc
 * @property string|null $extras
 * @property int|null $videoConsulta_id
 * @property int|null $usuario_portal_id
 * 
 * @property CancelacionOrigen|null $cancelacion_origen
 * @property UsuarioPortal|null $usuario_portal
 * @property VideoRoom|null $video_room
 * @property PersonaUsuarioPortal|null $persona_usuario_portal
 * @property TurnoProgramado|null $turno_programado
 * @property MotivoTurno|null $motivo_turno
 * @property Consultum|null $consultum
 * @property Agenda $agenda
 * @property Persona|null $persona
 * @property Plan|null $plan
 * @property EstadoTurno $estado_turno
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property Collection|Bono[] $bonos
 * @property Collection|CambioEstadoTurno[] $cambio_estado_turnos
 * @property CrmTurnoNotificacion|null $crm_turno_notificacion
 * @property Collection|Derivacion[] $derivacions
 * @property Collection|Envioapersona[] $envioapersonas
 * @property Solicitudturno|null $solicitudturno
 * @property Collection|StkEnvioapersona[] $stk_envioapersonas
 * @property Collection|TurnoDiagnostico[] $turno_diagnosticos
 * @property Collection|TurnoEstudio[] $turno_estudios
 * @property TurnoProgramadoCall|null $turno_programado_call
 * @property Collection|TurnosSugerencium[] $turnos_sugerencia
 *
 * @package App\Models
 */
class TurnoProgramado extends Model
{
	use SoftDeletes;
	protected $table = 'turno_programado';

	protected $casts = [
		'agenda_id' => 'int',
		'persona_id' => 'int',
		'plan_id' => 'int',
		'estado_turno_id' => 'int',
		'orden' => 'int',
		'fecha' => 'datetime',
		'hora' => 'datetime',
		'sobreturno' => 'bool',
		'fk_encuentro' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'consulta_id' => 'int',
		'institucion_id' => 'int',
		'tipovezqueconsulta' => 'int',
		'fechahora_arribo' => 'datetime',
		'fechahora_noasistio' => 'datetime',
		'usuarioarribo_id' => 'int',
		'usuarionoasistio_id' => 'int',
		'usuarioultimollamado_id' => 'int',
		'fechahora_ultimollamado' => 'datetime',
		'por_callcenter' => 'bool',
		'confirmado_por_paciente' => 'bool',
		'criterio' => 'int',
		'turno_portal_condicional' => 'bool',
		'turno_origen_id' => 'int',
		'motivo_turno_id' => 'int',
		'cancelacion_origen_id' => 'int',
		'persona_usuario_portal_id' => 'int',
		'videoConsulta_id' => 'int',
		'usuario_portal_id' => 'int'
	];

	protected $fillable = [
		'agenda_id',
		'persona_id',
		'plan_id',
		'estado_turno_id',
		'orden',
		'fecha',
		'hora',
		'sobreturno',
		'fk_encuentro',
		'created_by',
		'modified_by',
		'deleted_by',
		'consulta_id',
		'institucion_id',
		'observacion',
		'tipovezqueconsulta',
		'fechahora_arribo',
		'fechahora_noasistio',
		'usuarioarribo_id',
		'usuarionoasistio_id',
		'usuarioultimollamado_id',
		'fechahora_ultimollamado',
		'por_callcenter',
		'estado_msg',
		'confirmado_por_paciente',
		'criterio',
		'turno_portal_condicional',
		'turno_origen_id',
		'motivo_turno_id',
		'cancelacion_origen_id',
		'persona_usuario_portal_id',
		'codigo_ad_hoc',
		'extras',
		'videoConsulta_id',
		'usuario_portal_id'
	];

	public function cancelacion_origen()
	{
		return $this->belongsTo(CancelacionOrigen::class);
	}

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class);
	}

	public function video_room()
	{
		return $this->belongsTo(VideoRoom::class, 'videoConsulta_id');
	}

	public function persona_usuario_portal()
	{
		return $this->belongsTo(PersonaUsuarioPortal::class);
	}

	public function turno_programado()
	{
		return $this->hasOne(TurnoProgramado::class, 'turno_origen_id');
	}

	public function motivo_turno()
	{
		return $this->belongsTo(MotivoTurno::class);
	}

	public function consultum()
	{
		return $this->hasOne(Consultum::class, 'turno_id');
	}

	public function agenda()
	{
		return $this->belongsTo(Agenda::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function estado_turno()
	{
		return $this->belongsTo(EstadoTurno::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'usuarioultimollamado_id');
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class, 'turnoprogramado_id');
	}

	public function cambio_estado_turnos()
	{
		return $this->hasMany(CambioEstadoTurno::class, 'turno_id');
	}

	public function crm_turno_notificacion()
	{
		return $this->hasOne(CrmTurnoNotificacion::class, 'turno_id');
	}

	public function derivacions()
	{
		return $this->hasMany(Derivacion::class);
	}

	public function envioapersonas()
	{
		return $this->hasMany(Envioapersona::class, 'turno_id');
	}

	public function solicitudturno()
	{
		return $this->hasOne(Solicitudturno::class, 'turno_id');
	}

	public function stk_envioapersonas()
	{
		return $this->hasMany(StkEnvioapersona::class, 'turno_id');
	}

	public function turno_diagnosticos()
	{
		return $this->hasMany(TurnoDiagnostico::class, 'turno_id');
	}

	public function turno_estudios()
	{
		return $this->hasMany(TurnoEstudio::class, 'turno_id');
	}

	public function turno_programado_call()
	{
		return $this->hasOne(TurnoProgramadoCall::class, 'id');
	}

	public function turnos_sugerencia()
	{
		return $this->hasMany(TurnosSugerencium::class, 'turno_id');
	}
}
