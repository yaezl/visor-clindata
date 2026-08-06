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
 * Class Estudio
 * 
 * @property int $id
 * @property int|null $prestacion_id
 * @property string $nombre
 * @property string|null $sinonimo
 * @property string|null $preparacion
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * @property string|null $tipo
 * @property int|null $tipopractica_id
 * @property bool $borrado_logico
 * @property bool $requiere_autorizacion
 * @property bool $es_cirugia
 * @property string|null $informeTemplate
 * @property bool|null $es_anestesia
 * @property bool|null $es_tratamiento
 * @property bool|null $top_ordenes
 * @property bool|null $no_top_ordenes
 * @property float|null $honorario
 * @property float|null $gasto
 * @property bool $es_especial
 * @property int|null $intervalo_estudio_anterior
 * @property bool|null $impresion_diferencial
 * @property string|null $modalidad_ris
 * 
 * @property Prestacion|null $prestacion
 * @property Tipopractica|null $tipopractica
 * @property Collection|AdminEstudiosLaboratorio[] $admin_estudios_laboratorios
 * @property Collection|AgendaEstudio[] $agenda_estudios
 * @property Collection|Antecedentequirurgico[] $antecedentequirurgicos
 * @property Collection|AuditoriaEstudio[] $auditoria_estudios
 * @property Collection|AutorizacionesItem[] $autorizaciones_items
 * @property Collection|AutorizacionesPractica[] $autorizaciones_practicas
 * @property Collection|AutorizacionesReintegro[] $autorizaciones_reintegros
 * @property Collection|Bonoitem[] $bonoitems
 * @property Collection|CapituloodontologiaEstudio[] $capituloodontologia_estudios
 * @property Collection|Prestacion[] $prestacions
 * @property Collection|Estudiocomplementario[] $estudiocomplementarios
 * @property Collection|Estudioexterno[] $estudioexternos
 * @property Collection|Informedeestudio[] $informedeestudios
 * @property Collection|InternacionDetalleEstudiosInternacion[] $internacion_detalle_estudios_internacions
 * @property Collection|InternacionEstudioPq[] $internacion_estudio_pqs
 * @property Collection|ItemBono[] $item_bonos
 * @property Collection|KinesiologiaTratamiento[] $kinesiologia_tratamientos
 * @property Collection|OrdendeestudioEstudio[] $ordendeestudio_estudios
 * @property Collection|Permiso[] $permisos
 * @property Collection|PersonaObjetivo[] $persona_objetivos
 * @property Collection|Plan[] $plans
 * @property Collection|PrestadorinstitucionPractica[] $prestadorinstitucion_practicas
 * @property Collection|ProfesionalPlan[] $profesional_plans
 * @property Collection|ReglaAgendaPracticaLimite[] $regla_agenda_practica_limites
 * @property Collection|ServicioPaciente[] $servicio_pacientes
 * @property Collection|SolicitudEstudio[] $solicitud_estudios
 * @property Collection|TopOrdenesEstudio[] $top_ordenes_estudios
 * @property Collection|TurnoEstudio[] $turno_estudios
 *
 * @package App\Models
 */
class Estudio extends Model
{
	use SoftDeletes;
	protected $table = 'estudio';

	protected $casts = [
		'prestacion_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'tipopractica_id' => 'int',
		'borrado_logico' => 'bool',
		'requiere_autorizacion' => 'bool',
		'es_cirugia' => 'bool',
		'es_anestesia' => 'bool',
		'es_tratamiento' => 'bool',
		'top_ordenes' => 'bool',
		'no_top_ordenes' => 'bool',
		'honorario' => 'float',
		'gasto' => 'float',
		'es_especial' => 'bool',
		'intervalo_estudio_anterior' => 'int',
		'impresion_diferencial' => 'bool'
	];

	protected $fillable = [
		'prestacion_id',
		'nombre',
		'sinonimo',
		'preparacion',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo',
		'tipo',
		'tipopractica_id',
		'borrado_logico',
		'requiere_autorizacion',
		'es_cirugia',
		'informeTemplate',
		'es_anestesia',
		'es_tratamiento',
		'top_ordenes',
		'no_top_ordenes',
		'honorario',
		'gasto',
		'es_especial',
		'intervalo_estudio_anterior',
		'impresion_diferencial',
		'modalidad_ris'
	];

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function tipopractica()
	{
		return $this->belongsTo(Tipopractica::class);
	}

	public function admin_estudios_laboratorios()
	{
		return $this->hasMany(AdminEstudiosLaboratorio::class);
	}

	public function agenda_estudios()
	{
		return $this->hasMany(AgendaEstudio::class);
	}

	public function antecedentequirurgicos()
	{
		return $this->hasMany(Antecedentequirurgico::class);
	}

	public function auditoria_estudios()
	{
		return $this->hasMany(AuditoriaEstudio::class);
	}

	public function autorizaciones_items()
	{
		return $this->hasMany(AutorizacionesItem::class);
	}

	public function autorizaciones_practicas()
	{
		return $this->hasMany(AutorizacionesPractica::class, 'practica_id');
	}

	public function autorizaciones_reintegros()
	{
		return $this->belongsToMany(AutorizacionesReintegro::class, 'autorizaciones_reintegro_estudios', 'estudio_id', 'reintegro_id')
					->withPivot('id', 'created_by', 'modified_by', 'precio', 'borrado_logico')
					->withTimestamps();
	}

	public function bonoitems()
	{
		return $this->hasMany(Bonoitem::class, 'practica_id');
	}

	public function capituloodontologia_estudios()
	{
		return $this->hasMany(CapituloodontologiaEstudio::class);
	}

	public function prestacions()
	{
		return $this->belongsToMany(Prestacion::class)
					->withPivot('cantidad', 'id', 'creadopor_id', 'modificadopor_id', 'eliminadopor_id', 'creado_en', 'modificado_en', 'borrado_en', 'institucion_id');
	}

	public function estudiocomplementarios()
	{
		return $this->hasMany(Estudiocomplementario::class);
	}

	public function estudioexternos()
	{
		return $this->hasMany(Estudioexterno::class);
	}

	public function informedeestudios()
	{
		return $this->hasMany(Informedeestudio::class);
	}

	public function internacion_detalle_estudios_internacions()
	{
		return $this->hasMany(InternacionDetalleEstudiosInternacion::class);
	}

	public function internacion_estudio_pqs()
	{
		return $this->hasMany(InternacionEstudioPq::class);
	}

	public function item_bonos()
	{
		return $this->hasMany(ItemBono::class);
	}

	public function kinesiologia_tratamientos()
	{
		return $this->hasMany(KinesiologiaTratamiento::class);
	}

	public function ordendeestudio_estudios()
	{
		return $this->hasMany(OrdendeestudioEstudio::class);
	}

	public function permisos()
	{
		return $this->belongsToMany(Permiso::class, 'permiso_bloqueo_estudio')
					->withPivot('id', 'creadopor_id', 'modificadopor_id', 'creado_en', 'modificado_en');
	}

	public function persona_objetivos()
	{
		return $this->belongsToMany(PersonaObjetivo::class, 'persona_objetivo_estudios');
	}

	public function plans()
	{
		return $this->belongsToMany(Plan::class, 'plan_estudio');
	}

	public function prestadorinstitucion_practicas()
	{
		return $this->hasMany(PrestadorinstitucionPractica::class, 'practica_id');
	}

	public function profesional_plans()
	{
		return $this->hasMany(ProfesionalPlan::class);
	}

	public function regla_agenda_practica_limites()
	{
		return $this->hasMany(ReglaAgendaPracticaLimite::class);
	}

	public function servicio_pacientes()
	{
		return $this->hasMany(ServicioPaciente::class);
	}

	public function solicitud_estudios()
	{
		return $this->hasMany(SolicitudEstudio::class);
	}

	public function top_ordenes_estudios()
	{
		return $this->hasMany(TopOrdenesEstudio::class);
	}

	public function turno_estudios()
	{
		return $this->hasMany(TurnoEstudio::class);
	}
}
