<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReservaQuirofano
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $quirofano
 * @property int|null $grupo_sanguineo_id
 * @property int $tipo_anestesia
 * @property int $cama_destino
 * @property Carbon $fecha_hora_inicio
 * @property Carbon $fecha_hora_fin
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * @property bool $requiere_anatomia_patologica
 * @property bool $requiere_rx
 * @property bool $requiere_implante
 * @property bool $requiere_sangre
 * @property bool $en_modulo_propio
 * @property int|null $cantidad_unidades
 * @property int $duracion
 * @property string $descripcion_cirugia
 * @property string $descripcion_implante
 * @property string $lado_cirugia
 * @property bool $a_reprogramar
 * @property bool $alergia_latex
 * @property bool $alergia_sulfito
 * @property bool $intubacion_dificultosa
 * @property bool $paciente_internado
 * @property int|null $ordenProgramda_id
 * 
 * @property Usuario $usuario
 * @property InternacionQuirofanoCamaDestino $internacion_quirofano_cama_destino
 * @property InternacionQuirofanoTipoAnestesium $internacion_quirofano_tipo_anestesium
 * @property InternacionOrden|null $internacion_orden
 * @property GrupoSanguineo|null $grupo_sanguineo
 * @property InternacionQuirofano|null $internacion_quirofano
 * @property Collection|AuditoriaReservaQuirofano[] $auditoria_reserva_quirofanos
 * @property Collection|InternacionQuirofanoAuditoriaEnfermerium[] $internacion_quirofano_auditoria_enfermeria
 * @property Collection|InternacionQuirofanoAuditoriaLimpieza[] $internacion_quirofano_auditoria_limpiezas
 * @property Collection|InternacionQuirofanoAuditoriaQuirofano[] $internacion_quirofano_auditoria_quirofanos
 * @property Collection|InternacionQuirofanoAuditoriaRecepcion[] $internacion_quirofano_auditoria_recepcions
 * @property Collection|InternacionQuirofanoAuditoriaRecuperacion[] $internacion_quirofano_auditoria_recuperacions
 * @property Collection|ReservaQuirofanoEquipo[] $reserva_quirofano_equipos
 * @property Collection|ReservaQuirofanoMedicamento[] $reserva_quirofano_medicamentos
 * @property Collection|ReservaQuirofanoProfesional[] $reserva_quirofano_profesionals
 *
 * @package App\Models
 */
class ReservaQuirofano extends Model
{
	protected $table = 'reserva_quirofano';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'quirofano' => 'int',
		'grupo_sanguineo_id' => 'int',
		'tipo_anestesia' => 'int',
		'cama_destino' => 'int',
		'fecha_hora_inicio' => 'datetime',
		'fecha_hora_fin' => 'datetime',
		'borradoLogico' => 'bool',
		'requiere_anatomia_patologica' => 'bool',
		'requiere_rx' => 'bool',
		'requiere_implante' => 'bool',
		'requiere_sangre' => 'bool',
		'en_modulo_propio' => 'bool',
		'cantidad_unidades' => 'int',
		'duracion' => 'int',
		'a_reprogramar' => 'bool',
		'alergia_latex' => 'bool',
		'alergia_sulfito' => 'bool',
		'intubacion_dificultosa' => 'bool',
		'paciente_internado' => 'bool',
		'ordenProgramda_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'quirofano',
		'grupo_sanguineo_id',
		'tipo_anestesia',
		'cama_destino',
		'fecha_hora_inicio',
		'fecha_hora_fin',
		'borradoLogico',
		'requiere_anatomia_patologica',
		'requiere_rx',
		'requiere_implante',
		'requiere_sangre',
		'en_modulo_propio',
		'cantidad_unidades',
		'duracion',
		'descripcion_cirugia',
		'descripcion_implante',
		'lado_cirugia',
		'a_reprogramar',
		'alergia_latex',
		'alergia_sulfito',
		'intubacion_dificultosa',
		'paciente_internado',
		'ordenProgramda_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano_cama_destino()
	{
		return $this->belongsTo(InternacionQuirofanoCamaDestino::class, 'cama_destino');
	}

	public function internacion_quirofano_tipo_anestesium()
	{
		return $this->belongsTo(InternacionQuirofanoTipoAnestesium::class, 'tipo_anestesia');
	}

	public function internacion_orden()
	{
		return $this->belongsTo(InternacionOrden::class, 'ordenProgramda_id');
	}

	public function grupo_sanguineo()
	{
		return $this->belongsTo(GrupoSanguineo::class);
	}

	public function internacion_quirofano()
	{
		return $this->hasOne(InternacionQuirofano::class);
	}

	public function auditoria_reserva_quirofanos()
	{
		return $this->hasMany(AuditoriaReservaQuirofano::class, 'reservaQuirofano_id');
	}

	public function internacion_quirofano_auditoria_enfermeria()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaEnfermerium::class, 'reserva_id');
	}

	public function internacion_quirofano_auditoria_limpiezas()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaLimpieza::class, 'reserva_id');
	}

	public function internacion_quirofano_auditoria_quirofanos()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaQuirofano::class, 'reserva_id');
	}

	public function internacion_quirofano_auditoria_recepcions()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaRecepcion::class, 'reserva_id');
	}

	public function internacion_quirofano_auditoria_recuperacions()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaRecuperacion::class, 'reserva_id');
	}

	public function reserva_quirofano_equipos()
	{
		return $this->hasMany(ReservaQuirofanoEquipo::class, 'reserva_id');
	}

	public function reserva_quirofano_medicamentos()
	{
		return $this->hasMany(ReservaQuirofanoMedicamento::class);
	}

	public function reserva_quirofano_profesionals()
	{
		return $this->hasMany(ReservaQuirofanoProfesional::class);
	}
}
