<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaIndicacione
 * 
 * @property int $id
 * @property int|null $personal_id
 * @property int|null $persona_internacion_id
 * @property int|null $control_glucemia_id
 * @property int|null $correccion_insulina_cristalina_id
 * @property int|null $dieta_id
 * @property int|null $consistencia_id
 * @property int|null $movilidad_id
 * @property int|null $oxigenoterapia_id
 * @property int|null $periodicidad_nebulizaciones_id
 * @property int|null $kinesioterapia_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property Carbon $fecha
 * @property string|null $indicaciones
 * @property string|null $insulinaNPH
 * @property string|null $otraProteccionGastrica
 * @property string|null $otrasProfilaxis
 * @property string|null $analgesia
 * @property int|null $nebulizaciones
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property string|null $alergias
 * @property string|null $precauciones
 * @property string|null $alimentacion
 * @property string|null $textOxigenoterapia
 * 
 * @property Personal|null $personal
 * @property InternacionKinesioterapium|null $internacion_kinesioterapium
 * @property Usuario|null $usuario
 * @property InternacionPersona|null $internacion_persona
 * @property InternacionControlGlucemium|null $internacion_control_glucemium
 * @property InternacionCorreccionInsulinaCristalina|null $internacion_correccion_insulina_cristalina
 * @property InternacionDietum|null $internacion_dietum
 * @property InternacionConsistencium|null $internacion_consistencium
 * @property InternacionMovilidad|null $internacion_movilidad
 * @property InternacionOxigenoterapium|null $internacion_oxigenoterapium
 * @property InternacionPeriodicidadNebulizacione|null $internacion_periodicidad_nebulizacione
 * @property Collection|FarPlanHidratacion[] $far_plan_hidratacions
 * @property Collection|InternacionHiSolicitudMedicamento[] $internacion_hi_solicitud_medicamentos
 *
 * @package App\Models
 */
class InternacionHojaIndicacione extends Model
{
	protected $table = 'internacion_hoja_indicaciones';
	public $timestamps = false;

	protected $casts = [
		'personal_id' => 'int',
		'persona_internacion_id' => 'int',
		'control_glucemia_id' => 'int',
		'correccion_insulina_cristalina_id' => 'int',
		'dieta_id' => 'int',
		'consistencia_id' => 'int',
		'movilidad_id' => 'int',
		'oxigenoterapia_id' => 'int',
		'periodicidad_nebulizaciones_id' => 'int',
		'kinesioterapia_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'fecha' => 'datetime',
		'nebulizaciones' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'personal_id',
		'persona_internacion_id',
		'control_glucemia_id',
		'correccion_insulina_cristalina_id',
		'dieta_id',
		'consistencia_id',
		'movilidad_id',
		'oxigenoterapia_id',
		'periodicidad_nebulizaciones_id',
		'kinesioterapia_id',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'fecha',
		'indicaciones',
		'insulinaNPH',
		'otraProteccionGastrica',
		'otrasProfilaxis',
		'analgesia',
		'nebulizaciones',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'alergias',
		'precauciones',
		'alimentacion',
		'textOxigenoterapia'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function internacion_kinesioterapium()
	{
		return $this->belongsTo(InternacionKinesioterapium::class, 'kinesioterapia_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function internacion_control_glucemium()
	{
		return $this->belongsTo(InternacionControlGlucemium::class, 'control_glucemia_id');
	}

	public function internacion_correccion_insulina_cristalina()
	{
		return $this->belongsTo(InternacionCorreccionInsulinaCristalina::class, 'correccion_insulina_cristalina_id');
	}

	public function internacion_dietum()
	{
		return $this->belongsTo(InternacionDietum::class, 'dieta_id');
	}

	public function internacion_consistencium()
	{
		return $this->belongsTo(InternacionConsistencium::class, 'consistencia_id');
	}

	public function internacion_movilidad()
	{
		return $this->belongsTo(InternacionMovilidad::class, 'movilidad_id');
	}

	public function internacion_oxigenoterapium()
	{
		return $this->belongsTo(InternacionOxigenoterapium::class, 'oxigenoterapia_id');
	}

	public function internacion_periodicidad_nebulizacione()
	{
		return $this->belongsTo(InternacionPeriodicidadNebulizacione::class, 'periodicidad_nebulizaciones_id');
	}

	public function far_plan_hidratacions()
	{
		return $this->hasMany(FarPlanHidratacion::class, 'hoja_indicaciones_id');
	}

	public function internacion_hi_solicitud_medicamentos()
	{
		return $this->hasMany(InternacionHiSolicitudMedicamento::class, 'hoja_indicaciones_id');
	}
}
