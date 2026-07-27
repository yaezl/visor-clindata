<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionPersona
 * 
 * @property int $id
 * @property int $persona_id
 * @property int|null $plan_id
 * @property bool $borrado_logico
 * @property string|null $notas
 * @property Carbon|null $borrado_en
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property int|null $evento_id
 * @property string|null $codigo_ad_hoc
 * @property string|null $diagnostico_codigo_ad_hoc
 * 
 * @property Usuario|null $usuario
 * @property Persona $persona
 * @property Plan|null $plan
 * @property Eventohc|null $eventohc
 * @property Collection|AutorizacionPersonaInternacion[] $autorizacion_persona_internacions
 * @property Collection|Bono[] $bonos
 * @property Collection|FarSolicitudMedicamento[] $far_solicitud_medicamentos
 * @property Collection|Indicacion[] $indicacions
 * @property Collection|InternacionEnfermeriaEscalasValoracion[] $internacion_enfermeria_escalas_valoracions
 * @property Collection|InternacionEpicrisi[] $internacion_epicrisis
 * @property Collection|InternacionEstudiosInternacion[] $internacion_estudios_internacions
 * @property Collection|InternacionHojaEnfermeriaConsumoDescartable[] $internacion_hoja_enfermeria_consumo_descartables
 * @property Collection|InternacionHojaEnfermeriaControle[] $internacion_hoja_enfermeria_controles
 * @property Collection|InternacionHojaEnfermeriaEgreso[] $internacion_hoja_enfermeria_egresos
 * @property Collection|InternacionHojaEnfermeriaIndicacion[] $internacion_hoja_enfermeria_indicacions
 * @property Collection|InternacionHojaEnfermeriaIngreso[] $internacion_hoja_enfermeria_ingresos
 * @property Collection|InternacionHojaEnfermeriaMedicacion[] $internacion_hoja_enfermeria_medicacions
 * @property Collection|InternacionHojaEnfermeriaNota[] $internacion_hoja_enfermeria_notas
 * @property Collection|InternacionHojaEnfermeriaRiesgoCaida[] $internacion_hoja_enfermeria_riesgo_caidas
 * @property Collection|InternacionHojaEnfermeriaValoracionDolor[] $internacion_hoja_enfermeria_valoracion_dolors
 * @property InternacionHojaEvolucion|null $internacion_hoja_evolucion
 * @property Collection|InternacionHojaIndicacione[] $internacion_hoja_indicaciones
 * @property Collection|InternacionHojaIngreso[] $internacion_hoja_ingresos
 * @property Collection|InternacionInterconsultum[] $internacion_interconsulta
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 * @property Collection|InternacionParteQuirurgico[] $internacion_parte_quirurgicos
 * @property Collection|InternacionRecordAnestesico[] $internacion_record_anestesicos
 * @property Collection|PastoralEvento[] $pastoral_eventos
 * @property Collection|PastoralInternacionEtiquetum[] $pastoral_internacion_etiqueta
 * @property Collection|PersonainternacionInformedeestudio[] $personainternacion_informedeestudios
 *
 * @package App\Models
 */
class InternacionPersona extends Model
{
	protected $table = 'internacion_persona';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'plan_id' => 'int',
		'borrado_logico' => 'bool',
		'borrado_en' => 'datetime',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'evento_id' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'plan_id',
		'borrado_logico',
		'notas',
		'borrado_en',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'creado_en',
		'modificado_en',
		'evento_id',
		'codigo_ad_hoc',
		'diagnostico_codigo_ad_hoc'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function eventohc()
	{
		return $this->belongsTo(Eventohc::class, 'evento_id');
	}

	public function autorizacion_persona_internacions()
	{
		return $this->hasMany(AutorizacionPersonaInternacion::class, 'personaInternaciono_id');
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class, 'persona_internacion_id');
	}

	public function far_solicitud_medicamentos()
	{
		return $this->hasMany(FarSolicitudMedicamento::class, 'persona_internacion_id');
	}

	public function indicacions()
	{
		return $this->hasMany(Indicacion::class, 'persona_internacion_id');
	}

	public function internacion_enfermeria_escalas_valoracions()
	{
		return $this->hasMany(InternacionEnfermeriaEscalasValoracion::class, 'persona_internacion_id');
	}

	public function internacion_epicrisis()
	{
		return $this->hasMany(InternacionEpicrisi::class, 'persona_internacion_id');
	}

	public function internacion_estudios_internacions()
	{
		return $this->hasMany(InternacionEstudiosInternacion::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_consumo_descartables()
	{
		return $this->hasMany(InternacionHojaEnfermeriaConsumoDescartable::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_controles()
	{
		return $this->hasMany(InternacionHojaEnfermeriaControle::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_egresos()
	{
		return $this->hasMany(InternacionHojaEnfermeriaEgreso::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_indicacions()
	{
		return $this->hasMany(InternacionHojaEnfermeriaIndicacion::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_ingresos()
	{
		return $this->hasMany(InternacionHojaEnfermeriaIngreso::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_medicacions()
	{
		return $this->hasMany(InternacionHojaEnfermeriaMedicacion::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_notas()
	{
		return $this->hasMany(InternacionHojaEnfermeriaNota::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_riesgo_caidas()
	{
		return $this->hasMany(InternacionHojaEnfermeriaRiesgoCaida::class, 'persona_internacion_id');
	}

	public function internacion_hoja_enfermeria_valoracion_dolors()
	{
		return $this->hasMany(InternacionHojaEnfermeriaValoracionDolor::class, 'persona_internacion_id');
	}

	public function internacion_hoja_evolucion()
	{
		return $this->hasOne(InternacionHojaEvolucion::class, 'persona_internacion_id');
	}

	public function internacion_hoja_indicaciones()
	{
		return $this->hasMany(InternacionHojaIndicacione::class, 'persona_internacion_id');
	}

	public function internacion_hoja_ingresos()
	{
		return $this->hasMany(InternacionHojaIngreso::class, 'persona_internacion_id');
	}

	public function internacion_interconsulta()
	{
		return $this->hasMany(InternacionInterconsultum::class, 'persona_internacion_id');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'persona_internacion_id');
	}

	public function internacion_parte_quirurgicos()
	{
		return $this->hasMany(InternacionParteQuirurgico::class, 'persona_internacion_id');
	}

	public function internacion_record_anestesicos()
	{
		return $this->hasMany(InternacionRecordAnestesico::class, 'persona_internacion_id');
	}

	public function pastoral_eventos()
	{
		return $this->hasMany(PastoralEvento::class, 'persona_internacion_id');
	}

	public function pastoral_internacion_etiqueta()
	{
		return $this->hasMany(PastoralInternacionEtiquetum::class, 'personainternacion_id');
	}

	public function personainternacion_informedeestudios()
	{
		return $this->hasMany(PersonainternacionInformedeestudio::class, 'personainternacion_id');
	}
}
