<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitudturno
 * 
 * @property int $id
 * @property int|null $turno_id
 * @property int $persona_id
 * @property int|null $especialidad_id
 * @property int $solicitudturnoprioridad_id
 * @property int|null $institucion_id
 * @property int|null $personal_id
 * @property int $estadosolicitudturno_id
 * @property int $preferenciahorariasolicitud_id
 * @property int|null $usuario_cancela_id
 * @property int|null $usuario_rechaza_id
 * @property int|null $usuario_daturno_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $diagnostico
 * @property string|null $observacion
 * @property string|null $observacion_cema
 * @property string|null $observacion_rechazo
 * @property string|null $observacion_turnodado
 * @property bool|null $cancelacion_avisada
 * @property bool $sin_derivacion
 * @property Carbon|null $fechahora_cancela
 * @property Carbon|null $fechahora_rechaza
 * @property Carbon|null $fechahora_daturno
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $evento_id
 * @property bool $creado_por_medico
 * @property int|null $institucionDestino_id
 * @property int|null $medico_responsable_id
 * @property string $motivo
 * 
 * @property Personal|null $personal
 * @property TurnoProgramado|null $turno_programado
 * @property Usuario|null $usuario
 * @property Institucion|null $institucion
 * @property Eventohc|null $eventohc
 * @property Persona $persona
 * @property Especialidad|null $especialidad
 * @property Solicitudturnoprioridad $solicitudturnoprioridad
 * @property Estadosolicitudturno $estadosolicitudturno
 * @property Preferenciahorariasolicitud $preferenciahorariasolicitud
 * @property Collection|SolicitudEstudio[] $solicitud_estudios
 *
 * @package App\Models
 */
class Solicitudturno extends Model
{
	protected $table = 'solicitudturno';
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'persona_id' => 'int',
		'especialidad_id' => 'int',
		'solicitudturnoprioridad_id' => 'int',
		'institucion_id' => 'int',
		'personal_id' => 'int',
		'estadosolicitudturno_id' => 'int',
		'preferenciahorariasolicitud_id' => 'int',
		'usuario_cancela_id' => 'int',
		'usuario_rechaza_id' => 'int',
		'usuario_daturno_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'cancelacion_avisada' => 'bool',
		'sin_derivacion' => 'bool',
		'fechahora_cancela' => 'datetime',
		'fechahora_rechaza' => 'datetime',
		'fechahora_daturno' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'evento_id' => 'int',
		'creado_por_medico' => 'bool',
		'institucionDestino_id' => 'int',
		'medico_responsable_id' => 'int'
	];

	protected $fillable = [
		'turno_id',
		'persona_id',
		'especialidad_id',
		'solicitudturnoprioridad_id',
		'institucion_id',
		'personal_id',
		'estadosolicitudturno_id',
		'preferenciahorariasolicitud_id',
		'usuario_cancela_id',
		'usuario_rechaza_id',
		'usuario_daturno_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'diagnostico',
		'observacion',
		'observacion_cema',
		'observacion_rechazo',
		'observacion_turnodado',
		'cancelacion_avisada',
		'sin_derivacion',
		'fechahora_cancela',
		'fechahora_rechaza',
		'fechahora_daturno',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'evento_id',
		'creado_por_medico',
		'institucionDestino_id',
		'medico_responsable_id',
		'motivo'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'usuario_cancela_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function eventohc()
	{
		return $this->belongsTo(Eventohc::class, 'evento_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function solicitudturnoprioridad()
	{
		return $this->belongsTo(Solicitudturnoprioridad::class);
	}

	public function estadosolicitudturno()
	{
		return $this->belongsTo(Estadosolicitudturno::class);
	}

	public function preferenciahorariasolicitud()
	{
		return $this->belongsTo(Preferenciahorariasolicitud::class);
	}

	public function solicitud_estudios()
	{
		return $this->hasMany(SolicitudEstudio::class, 'turno_id');
	}
}
