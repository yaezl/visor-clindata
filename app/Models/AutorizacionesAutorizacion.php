<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesAutorizacion
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $estado_id
 * @property int|null $persona_id
 * @property string|null $nota
 * @property bool $internacion
 * @property Carbon|null $fecha_ingreso
 * @property string|null $hora_ingreso
 * @property Carbon|null $fecha_egreso
 * @property Carbon|null $fecha_vencimiento
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * @property int|null $personal_interno_id
 * @property int|null $origen_id
 * @property int|null $tipo_prestacion_id
 * @property int|null $prestador_id
 * @property int|null $prestador_institucion_id
 * @property int|null $plan_id
 * @property bool $externo
 * @property string|null $personal_externo
 * @property int|null $personal_derivante_interno_id
 * @property int|null $especialidad_id
 * @property int|null $institucion_destino_id
 * @property string|null $personal_derivante_externo
 * @property string|null $numero_manual
 * @property bool $consumida
 * @property string|null $numeroOperacion
 * @property int|null $autorizacion_montos
 * 
 * @property Collection|AutorizacionAprobacione[] $autorizacion_aprobaciones
 * @property Collection|AutorizacionItem[] $autorizacion_items
 * @property Collection|AutorizacionPersonaInternacion[] $autorizacion_persona_internacions
 * @property Collection|AutorizacionesAuditoriaEstado[] $autorizaciones_auditoria_estados
 * @property Collection|Archivo[] $archivos
 * @property Collection|AutorizacionesDiagnostico[] $autorizaciones_diagnosticos
 * @property Collection|AutorizacionesMedicacion[] $autorizaciones_medicacions
 * @property Collection|AutorizacionesNota[] $autorizaciones_notas
 * @property Collection|AutorizacionesNotasAuditorFacturacion[] $autorizaciones_notas_auditor_facturacions
 * @property Collection|AutorizacionesPractica[] $autorizaciones_practicas
 * @property AutorizacionesReintegro|null $autorizaciones_reintegro
 *
 * @package App\Models
 */
class AutorizacionesAutorizacion extends Model
{
	protected $table = 'autorizaciones_autorizacion';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'estado_id' => 'int',
		'persona_id' => 'int',
		'internacion' => 'bool',
		'fecha_ingreso' => 'datetime',
		'fecha_egreso' => 'datetime',
		'fecha_vencimiento' => 'datetime',
		'borrado_logico' => 'bool',
		'personal_interno_id' => 'int',
		'origen_id' => 'int',
		'tipo_prestacion_id' => 'int',
		'prestador_id' => 'int',
		'prestador_institucion_id' => 'int',
		'plan_id' => 'int',
		'externo' => 'bool',
		'personal_derivante_interno_id' => 'int',
		'especialidad_id' => 'int',
		'institucion_destino_id' => 'int',
		'consumida' => 'bool',
		'autorizacion_montos' => 'int'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'estado_id',
		'persona_id',
		'nota',
		'internacion',
		'fecha_ingreso',
		'hora_ingreso',
		'fecha_egreso',
		'fecha_vencimiento',
		'borrado_logico',
		'personal_interno_id',
		'origen_id',
		'tipo_prestacion_id',
		'prestador_id',
		'prestador_institucion_id',
		'plan_id',
		'externo',
		'personal_externo',
		'personal_derivante_interno_id',
		'especialidad_id',
		'institucion_destino_id',
		'personal_derivante_externo',
		'numero_manual',
		'consumida',
		'numeroOperacion',
		'autorizacion_montos'
	];

	public function autorizacion_aprobaciones()
	{
		return $this->hasMany(AutorizacionAprobacione::class, 'autorizacion_id');
	}

	public function autorizacion_items()
	{
		return $this->hasMany(AutorizacionItem::class, 'autorizacion_id');
	}

	public function autorizacion_persona_internacions()
	{
		return $this->hasMany(AutorizacionPersonaInternacion::class, 'autorizacion_id');
	}

	public function autorizaciones_auditoria_estados()
	{
		return $this->hasMany(AutorizacionesAuditoriaEstado::class, 'autorizacion_id');
	}

	public function archivos()
	{
		return $this->belongsToMany(Archivo::class, 'autorizaciones_autorizacion_archivo', 'autorizacion_id')
					->withPivot('id', 'created_by', 'modified_by', 'deleted_by', 'comentario', 'activo', 'tipo_archivo', 'deleted_at', 'borrado_logico')
					->withTimestamps();
	}

	public function autorizaciones_diagnosticos()
	{
		return $this->hasMany(AutorizacionesDiagnostico::class, 'autorizacion_id');
	}

	public function autorizaciones_medicacions()
	{
		return $this->hasMany(AutorizacionesMedicacion::class, 'autorizacion_id');
	}

	public function autorizaciones_notas()
	{
		return $this->hasMany(AutorizacionesNota::class, 'autorizacion_id');
	}

	public function autorizaciones_notas_auditor_facturacions()
	{
		return $this->hasMany(AutorizacionesNotasAuditorFacturacion::class, 'autorizacion_id');
	}

	public function autorizaciones_practicas()
	{
		return $this->hasMany(AutorizacionesPractica::class, 'autorizacion_id');
	}

	public function autorizaciones_reintegro()
	{
		return $this->hasOne(AutorizacionesReintegro::class, 'autorizacion_id');
	}
}
