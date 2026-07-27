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
 * Class Plan
 * 
 * @property int $id
 * @property int $obra_social_id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borrado_logico
 * @property bool $es_por_defecto
 * @property bool $es_sin_cobertura
 * @property bool $habilitado_autorizaciones
 * @property float|null $iva
 * @property int|null $moneda_deuda_id
 * @property string|null $observacion_alerta
 * @property string|null $codigo_ad_hoc
 * @property int|null $tope_deuda
 * @property bool $habilitado_autoseguros
 * @property int|null $limite_autoseguros
 * @property string $observacion_alerta_his
 * @property string|null $nombreEnRecetaElec
 * @property bool $requiere_firma
 * @property bool $requiere_codigo_seguridad
 * 
 * @property Moneda|null $moneda
 * @property ObraSocial $obra_social
 * @property Collection|AutorizacionesPlanAtpTipocobertura[] $autorizaciones_plan_atp_tipocoberturas
 * @property Collection|Bono[] $bonos
 * @property Collection|Facturacriterio[] $facturacriterios
 * @property Collection|InternacionPersona[] $internacion_personas
 * @property Collection|Persona[] $personas
 * @property Collection|Prestacion[] $prestacions
 * @property Collection|Estudio[] $estudios
 * @property Collection|Institucion[] $institucions
 * @property Collection|PlanesListaBlanca[] $planes_lista_blancas
 * @property Collection|Prefacturacriterio[] $prefacturacriterios
 * @property Collection|ProfesionalPlan[] $profesional_plans
 * @property Collection|ReglaAgenda[] $regla_agendas
 * @property Collection|TedefLotesFacturacion[] $tedef_lotes_facturacions
 * @property Collection|TurnoGuardium[] $turno_guardia
 * @property Collection|TurnoProgramado[] $turno_programados
 *
 * @package App\Models
 */
class Plan extends Model
{
	use SoftDeletes;
	protected $table = 'plan';

	protected $casts = [
		'obra_social_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borrado_logico' => 'bool',
		'es_por_defecto' => 'bool',
		'es_sin_cobertura' => 'bool',
		'habilitado_autorizaciones' => 'bool',
		'iva' => 'float',
		'moneda_deuda_id' => 'int',
		'tope_deuda' => 'int',
		'habilitado_autoseguros' => 'bool',
		'limite_autoseguros' => 'int',
		'requiere_firma' => 'bool',
		'requiere_codigo_seguridad' => 'bool'
	];

	protected $fillable = [
		'obra_social_id',
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'borrado_logico',
		'es_por_defecto',
		'es_sin_cobertura',
		'habilitado_autorizaciones',
		'iva',
		'moneda_deuda_id',
		'observacion_alerta',
		'codigo_ad_hoc',
		'tope_deuda',
		'habilitado_autoseguros',
		'limite_autoseguros',
		'observacion_alerta_his',
		'nombreEnRecetaElec',
		'requiere_firma',
		'requiere_codigo_seguridad'
	];

	public function moneda()
	{
		return $this->belongsTo(Moneda::class, 'moneda_deuda_id');
	}

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class);
	}

	public function autorizaciones_plan_atp_tipocoberturas()
	{
		return $this->hasMany(AutorizacionesPlanAtpTipocobertura::class);
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class);
	}

	public function facturacriterios()
	{
		return $this->hasMany(Facturacriterio::class);
	}

	public function internacion_personas()
	{
		return $this->hasMany(InternacionPersona::class);
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class)
					->withPivot('id', 'tipo_beneficiario_id', 'tipo_parentesco_id', 'nro_beneficiario', 'created_by', 'modified_by', 'deleted_at', 'deleted_by', 'condicion_iva_id', 'borrado_logico', 'tipo_plan', 'modalidad_contratacion_id', 'plan_beneficios_id', 'codigoSeguridad')
					->withTimestamps();
	}

	public function prestacions()
	{
		return $this->belongsToMany(Prestacion::class, 'plan_cantidad_prestaciones')
					->withPivot('id', 'created_by', 'updated_by', 'cantidad_prestaciones', 'borrado_logico')
					->withTimestamps();
	}

	public function estudios()
	{
		return $this->belongsToMany(Estudio::class, 'plan_estudio');
	}

	public function institucions()
	{
		return $this->belongsToMany(Institucion::class, 'plan_institucion')
					->withPivot('id', 'dias_de_vencimiento', 'es_particular', 'copago_variable', 'es_por_defecto', 'created_by', 'modified_by', 'deleted_at', 'deleted_by', 'borrado_logico', 'planTotem', 'numero_contrato')
					->withTimestamps();
	}

	public function planes_lista_blancas()
	{
		return $this->hasMany(PlanesListaBlanca::class);
	}

	public function prefacturacriterios()
	{
		return $this->hasMany(Prefacturacriterio::class);
	}

	public function profesional_plans()
	{
		return $this->hasMany(ProfesionalPlan::class);
	}

	public function regla_agendas()
	{
		return $this->belongsToMany(ReglaAgenda::class, 'regla_agenda_plan', 'plan_id', 'id')
					->withPivot('cantidad', 'os_completa');
	}

	public function tedef_lotes_facturacions()
	{
		return $this->hasMany(TedefLotesFacturacion::class);
	}

	public function turno_guardia()
	{
		return $this->hasMany(TurnoGuardium::class);
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}
}
