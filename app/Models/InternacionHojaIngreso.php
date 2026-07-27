<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaIngreso
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property int|null $persona_internacion_id
 * @property int|null $responsable_id
 * @property string|null $motivo
 * @property string|null $aparatos
 * @property string|null $conciencia
 * @property float|null $tensionArterialMaxima
 * @property float|null $tensionArterialMinima
 * @property float|null $peso
 * @property float|null $talla
 * @property float|null $temperatura
 * @property float|null $frecuenciaCardiaca
 * @property float|null $frecuenciaRespiratoria
 * @property float|null $saturacionOxigeno
 * @property float|null $hgt
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property string|null $observacion_general
 * @property string|null $estado_general
 * @property string|null $sistema_nervioso
 * @property string|null $musculo_esqueletico
 * @property string|null $observacion_fisico
 * @property string|null $neurologico
 * @property string|null $lenguaje_memoria
 * @property string|null $sensopercepcion
 * @property string|null $actitud
 * @property string|null $observacion_psicosemiologico
 * @property int|null $responsable2_id
 * @property string|null $antecedentesEnfermedadActual
 * @property string|null $enfermedadActual
 * @property string|null $aparatoRespiratorio
 * @property string|null $aparatoCardiovascular
 * @property string|null $aparatoDigestivo
 * @property string|null $aparatoGenitourinario
 * @property string|null $orientacion
 * @property string|null $aspecto
 * @property string|null $organoSentidos
 * @property string|null $atencion
 * @property string|null $actividad
 * @property string|null $afectividad
 * @property string|null $pensamiento
 * @property string|null $concienciaSituacionEnfermedad
 * @property string|null $voluntad
 * @property string|null $estadoFuncional
 * @property string|null $sociabilizacion
 * @property string|null $psicomotricidad
 * @property string|null $orexia
 * @property string|null $sueno
 * @property string|null $resultadoToxicologico
 * @property string|null $fundamentoInternacion
 * @property string|null $memoria
 * @property bool|null $pronosticoFuncion
 * @property bool|null $pronosticoVida
 * 
 * @property Usuario|null $usuario
 * @property Persona|null $persona
 * @property InternacionPersona|null $internacion_persona
 * @property Collection|HojaIngresoDiagnostico[] $hoja_ingreso_diagnosticos
 *
 * @package App\Models
 */
class InternacionHojaIngreso extends Model
{
	protected $table = 'internacion_hoja_ingreso';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'responsable_id' => 'int',
		'tensionArterialMaxima' => 'float',
		'tensionArterialMinima' => 'float',
		'peso' => 'float',
		'talla' => 'float',
		'temperatura' => 'float',
		'frecuenciaCardiaca' => 'float',
		'frecuenciaRespiratoria' => 'float',
		'saturacionOxigeno' => 'float',
		'hgt' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'responsable2_id' => 'int',
		'pronosticoFuncion' => 'bool',
		'pronosticoVida' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'persona_internacion_id',
		'responsable_id',
		'motivo',
		'aparatos',
		'conciencia',
		'tensionArterialMaxima',
		'tensionArterialMinima',
		'peso',
		'talla',
		'temperatura',
		'frecuenciaCardiaca',
		'frecuenciaRespiratoria',
		'saturacionOxigeno',
		'hgt',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'observacion_general',
		'estado_general',
		'sistema_nervioso',
		'musculo_esqueletico',
		'observacion_fisico',
		'neurologico',
		'lenguaje_memoria',
		'sensopercepcion',
		'actitud',
		'observacion_psicosemiologico',
		'responsable2_id',
		'antecedentesEnfermedadActual',
		'enfermedadActual',
		'aparatoRespiratorio',
		'aparatoCardiovascular',
		'aparatoDigestivo',
		'aparatoGenitourinario',
		'orientacion',
		'aspecto',
		'organoSentidos',
		'atencion',
		'actividad',
		'afectividad',
		'pensamiento',
		'concienciaSituacionEnfermedad',
		'voluntad',
		'estadoFuncional',
		'sociabilizacion',
		'psicomotricidad',
		'orexia',
		'sueno',
		'resultadoToxicologico',
		'fundamentoInternacion',
		'memoria',
		'pronosticoFuncion',
		'pronosticoVida'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'responsable2_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function hoja_ingreso_diagnosticos()
	{
		return $this->hasMany(HojaIngresoDiagnostico::class, 'hoja_ingreso_id');
	}
}
