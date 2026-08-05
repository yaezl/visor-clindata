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
 * Class Persona
 * 
 * @property int $id
 * @property int $direccion_id
 * @property int|null $cuenta_id
 * @property int $pais_id
 * @property int $estado_civil_id
 * @property int $tipo_documento_id
 * @property string|null $documento
 * @property string $apellidos
 * @property string $nombres
 * @property string $apellido_materno
 * @property Carbon $fecha_nacimiento
 * @property string $genero
 * @property string $cuil
 * @property int|null $nro_hc
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $estado_id
 * @property int|null $empleador_id
 * @property string|null $nombre_alias
 * @property bool|null $usar_nombre_alias
 * @property string|null $edad_aproximada
 * @property string $sexo
 * @property int|null $nivelinstruccion_id
 * @property bool|null $usar_edad_aproximada
 * @property Carbon|null $fecha_edad_aproximada
 * @property string|null $estado_msg
 * @property int|null $causa_hc_pasiva_id
 * @property int|null $grupo_sanguineo_id
 * @property int|null $direccion_nacimiento_id
 * @property bool $borrado_logico
 * @property string|null $telefono_codigo
 * @property string|null $telefono_numero
 * @property string|null $contacto_telefono_codigo
 * @property string|null $contacto_telefono_numero
 * @property bool|null $social_login
 * @property string|null $contacto_telefono_carrier
 * @property string|null $observaciones
 * @property Carbon $last_sintys_validation
 * @property int|null $direccion_extranjera_id
 * @property int|null $pais_extranjero_id
 * @property int|null $pais_nacimiento_id
 * @property int|null $condicion_iva
 * @property int|null $religion_id
 * @property bool $acepto_terminos_condiciones
 * @property string|null $codigo_ad_hoc
 * @property bool $tiene_incapacidad
 * @property bool $es_cronico
 * @property bool $no_acepta_donacion_sanguinea
 * @property string|null $contacto_telefono_prefijo
 * @property string|null $contacto_celular_codigo
 * @property string|null $contacto_celular_numero
 * @property string|null $contacto_celular_prefijo
 * @property string|null $contacto_celular_carrier
 * @property string|null $contacto_email_direccion
 * @property int|null $grupoEtnico_id
 * @property int $genero_id
 * 
 * @property Direccion $direccion
 * @property Pai $pai
 * @property Religion|null $religion
 * @property Usuario $usuario
 * @property GruposEtnico|null $grupos_etnico
 * @property GrupoSanguineo|null $grupo_sanguineo
 * @property Cuentum|null $cuentum
 * @property EstadoCivil $estado_civil
 * @property TipoDocumento $tipo_documento
 * @property Estadopersona|null $estadopersona
 * @property Empleador|null $empleador
 * @property Nivelinstruccion|null $nivelinstruccion
 * @property CausaHcPasiva|null $causa_hc_pasiva
 * @property Collection|AdminWsApiUsuarioPaciente[] $admin_ws_api_usuario_pacientes
 * @property Collection|AntecedenteNOpatologico[] $antecedente_n_opatologicos
 * @property Collection|Antecedentehabitonocivo[] $antecedentehabitonocivos
 * @property Collection|Antecedenteheredofamiliar[] $antecedenteheredofamiliars
 * @property Collection|Antecedentenutricionalpediatrico[] $antecedentenutricionalpediatricos
 * @property Collection|Antecedentepatologico[] $antecedentepatologicos
 * @property Collection|Antecedenteperinatal[] $antecedenteperinatals
 * @property Collection|Antecedentequirurgico[] $antecedentequirurgicos
 * @property Collection|AreaPrivada[] $area_privadas
 * @property Collection|Articulocronico[] $articulocronicos
 * @property Collection|Bono[] $bonos
 * @property Collection|ConsultaMedicionGinecologium[] $consulta_medicion_ginecologia
 * @property Collection|CrmVacunaNotificacion[] $crm_vacuna_notificacions
 * @property Collection|DietaPaciente[] $dieta_pacientes
 * @property Collection|DocumentosHc[] $documentos_hcs
 * @property Collection|EntrenamientoPaciente[] $entrenamiento_pacientes
 * @property Collection|Estudioexterno[] $estudioexternos
 * @property Collection|EstudioexternoLaboratorio[] $estudioexterno_laboratorios
 * @property Collection|Eventohc[] $eventohcs
 * @property Collection|Familium[] $familia
 * @property Collection|Familiarelacion[] $familiarelacions
 * @property Collection|Fisioterapium[] $fisioterapia
 * @property Collection|HcInformacionAdicional[] $hc_informacion_adicionals
 * @property Collection|HcPerinatal[] $hc_perinatals
 * @property Collection|InternacionHojaIngreso[] $internacion_hoja_ingresos
 * @property Collection|InternacionPersona[] $internacion_personas
 * @property Collection|Medicion[] $medicions
 * @property Collection|MedicionesAntropometrica[] $mediciones_antropometricas
 * @property Collection|MovimientoCaja[] $movimiento_cajas
 * @property Collection|Odontoaplicacion[] $odontoaplicacions
 * @property Collection|PastoralEventoParticipante[] $pastoral_evento_participantes
 * @property Collection|Archivo[] $archivos
 * @property Collection|PersonaAuditorium[] $persona_auditoria
 * @property PersonaEducacion|null $persona_educacion
 * @property Collection|PersonaEmpleado[] $persona_empleados
 * @property Collection|Objetivo[] $objetivos
 * @property Collection|Plan[] $plans
 * @property PersonaPlanPorDefecto|null $persona_plan_por_defecto
 * @property Collection|Plansocial[] $plansocials
 * @property Collection|PersonaTipoContribuyente[] $persona_tipo_contribuyentes
 * @property PersonaTrabajo|null $persona_trabajo
 * @property Collection|Usuario[] $usuarios
 * @property Collection|UsuarioPortal[] $usuario_portals
 * @property Collection|PersonaVivienda[] $persona_viviendas
 * @property Collection|Personacuentum[] $personacuenta
 * @property Personal|null $personal
 * @property Collection|RudRud[] $rud_ruds
 * @property Collection|Solicitudturno[] $solicitudturnos
 * @property Collection|TratamientoKinesiologium[] $tratamiento_kinesiologia
 * @property Collection|TurnoGuardium[] $turno_guardia
 * @property Collection|TurnoProgramado[] $turno_programados
 *
 * @package App\Models
 */
class Persona extends Model
{
	use SoftDeletes;
	protected $table = 'persona';

	protected $casts = [
		'direccion_id' => 'int',
		'cuenta_id' => 'int',
		'pais_id' => 'int',
		'estado_civil_id' => 'int',
		'tipo_documento_id' => 'int',
		'fecha_nacimiento' => 'datetime',
		'nro_hc' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'estado_id' => 'int',
		'empleador_id' => 'int',
		'usar_nombre_alias' => 'bool',
		'nivelinstruccion_id' => 'int',
		'usar_edad_aproximada' => 'bool',
		'fecha_edad_aproximada' => 'datetime',
		'causa_hc_pasiva_id' => 'int',
		'grupo_sanguineo_id' => 'int',
		'direccion_nacimiento_id' => 'int',
		'borrado_logico' => 'bool',
		'social_login' => 'bool',
		'last_sintys_validation' => 'datetime',
		'direccion_extranjera_id' => 'int',
		'pais_extranjero_id' => 'int',
		'pais_nacimiento_id' => 'int',
		'condicion_iva' => 'int',
		'religion_id' => 'int',
		'acepto_terminos_condiciones' => 'bool',
		'tiene_incapacidad' => 'bool',
		'es_cronico' => 'bool',
		'no_acepta_donacion_sanguinea' => 'bool',
		'grupoEtnico_id' => 'int',
		'genero_id' => 'int'
	];

	protected $fillable = [
		'direccion_id',
		'cuenta_id',
		'pais_id',
		'estado_civil_id',
		'tipo_documento_id',
		'documento',
		'apellidos',
		'nombres',
		'apellido_materno',
		'fecha_nacimiento',
		'genero',
		'cuil',
		'nro_hc',
		'created_by',
		'modified_by',
		'deleted_by',
		'estado_id',
		'empleador_id',
		'nombre_alias',
		'usar_nombre_alias',
		'edad_aproximada',
		'sexo',
		'nivelinstruccion_id',
		'usar_edad_aproximada',
		'fecha_edad_aproximada',
		'estado_msg',
		'causa_hc_pasiva_id',
		'grupo_sanguineo_id',
		'direccion_nacimiento_id',
		'borrado_logico',
		'telefono_codigo',
		'telefono_numero',
		'contacto_telefono_codigo',
		'contacto_telefono_numero',
		'social_login',
		'contacto_telefono_carrier',
		'observaciones',
		'last_sintys_validation',
		'direccion_extranjera_id',
		'pais_extranjero_id',
		'pais_nacimiento_id',
		'condicion_iva',
		'religion_id',
		'acepto_terminos_condiciones',
		'codigo_ad_hoc',
		'tiene_incapacidad',
		'es_cronico',
		'no_acepta_donacion_sanguinea',
		'contacto_telefono_prefijo',
		'contacto_celular_codigo',
		'contacto_celular_numero',
		'contacto_celular_prefijo',
		'contacto_celular_carrier',
		'contacto_email_direccion',
		'grupoEtnico_id',
		'genero_id'
	];

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}

	public function pai()
	{
		return $this->belongsTo(Pai::class, 'pais_id');
	}

	public function religion()
	{
		return $this->belongsTo(Religion::class);
	}

	public function genero()
	{
		return $this->belongsTo(Genero::class);
	}

	public function condicion_iva()
	{
		return $this->belongsTo(CondicionIva::class, 'condicion_iva');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function grupos_etnico()
	{
		return $this->belongsTo(GruposEtnico::class, 'grupoEtnico_id');
	}

	public function grupo_sanguineo()
	{
		return $this->belongsTo(GrupoSanguineo::class);
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'cuenta_id');
	}

	public function estado_civil()
	{
		return $this->belongsTo(EstadoCivil::class);
	}

	public function tipo_documento()
	{
		return $this->belongsTo(TipoDocumento::class);
	}

	public function estadopersona()
	{
		return $this->belongsTo(Estadopersona::class, 'estado_id');
	}

	public function empleador()
	{
		return $this->belongsTo(Empleador::class);
	}

	public function nivelinstruccion()
	{
		return $this->belongsTo(Nivelinstruccion::class);
	}

	public function causa_hc_pasiva()
	{
		return $this->belongsTo(CausaHcPasiva::class);
	}

	public function admin_ws_api_usuario_pacientes()
	{
		return $this->hasMany(AdminWsApiUsuarioPaciente::class, 'paciente_id');
	}

	public function antecedente_n_opatologicos()
	{
		return $this->hasMany(AntecedenteNOpatologico::class);
	}

	public function antecedentehabitonocivos()
	{
		return $this->hasMany(Antecedentehabitonocivo::class);
	}

	public function antecedenteheredofamiliars()
	{
		return $this->hasMany(Antecedenteheredofamiliar::class);
	}

	public function antecedentenutricionalpediatricos()
	{
		return $this->hasMany(Antecedentenutricionalpediatrico::class);
	}

	public function antecedentepatologicos()
	{
		return $this->hasMany(Antecedentepatologico::class);
	}

	public function antecedenteperinatals()
	{
		return $this->hasMany(Antecedenteperinatal::class);
	}

	public function antecedentequirurgicos()
	{
		return $this->hasMany(Antecedentequirurgico::class);
	}

	public function area_privadas()
	{
		return $this->hasMany(AreaPrivada::class);
	}

	public function articulocronicos()
	{
		return $this->hasMany(Articulocronico::class);
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class);
	}

	public function consulta_medicion_ginecologia()
	{
		return $this->hasMany(ConsultaMedicionGinecologium::class);
	}

	public function crm_vacuna_notificacions()
	{
		return $this->hasMany(CrmVacunaNotificacion::class);
	}

	public function dieta_pacientes()
	{
		return $this->hasMany(DietaPaciente::class);
	}

	public function documentos_hcs()
	{
		return $this->hasMany(DocumentosHc::class, 'paciente_id');
	}

	public function entrenamiento_pacientes()
	{
		return $this->hasMany(EntrenamientoPaciente::class);
	}

	public function estudioexternos()
	{
		return $this->hasMany(Estudioexterno::class);
	}

	public function estudioexterno_laboratorios()
	{
		return $this->hasMany(EstudioexternoLaboratorio::class);
	}

	public function eventohcs()
	{
		return $this->hasMany(Eventohc::class);
	}

	public function familia()
	{
		return $this->hasMany(Familium::class, 'jefeDeFamilia_id');
	}

	public function familiarelacions()
	{
		return $this->hasMany(Familiarelacion::class, 'individuo2_id');
	}

	public function fisioterapia()
	{
		return $this->hasMany(Fisioterapium::class);
	}

	public function hc_informacion_adicionals()
	{
		return $this->hasMany(HcInformacionAdicional::class);
	}

	public function hc_perinatals()
	{
		return $this->hasMany(HcPerinatal::class);
	}

	public function internacion_hoja_ingresos()
	{
		return $this->hasMany(InternacionHojaIngreso::class, 'responsable2_id');
	}

	public function internacion_personas()
	{
		return $this->hasMany(InternacionPersona::class);
	}

	public function medicions()
	{
		return $this->hasMany(Medicion::class);
	}

	public function mediciones_antropometricas()
	{
		return $this->hasMany(MedicionesAntropometrica::class);
	}

	public function movimiento_cajas()
	{
		return $this->hasMany(MovimientoCaja::class);
	}

	public function odontoaplicacions()
	{
		return $this->hasMany(Odontoaplicacion::class);
	}

	public function pastoral_evento_participantes()
	{
		return $this->hasMany(PastoralEventoParticipante::class, 'participante_id');
	}

	public function archivos()
	{
		return $this->belongsToMany(Archivo::class, 'persona_archivo')
			->withPivot('id', 'creadopor_id', 'modificadopor_id', 'eliminado_por_id', 'comentario', 'activo', 'creado_en', 'modificado_en', 'borrado_en', 'tipo_archivo');
	}

	public function persona_auditoria()
	{
		return $this->hasMany(PersonaAuditorium::class, 'unificadoConPersona_id');
	}

	public function persona_educacion()
	{
		return $this->hasOne(PersonaEducacion::class);
	}

	public function persona_empleados()
	{
		return $this->hasMany(PersonaEmpleado::class);
	}

	public function objetivos()
	{
		return $this->belongsToMany(Objetivo::class, 'persona_objetivo')
			->withPivot('id');
	}

	public function plans()
	{
		return $this->belongsToMany(Plan::class)
			->withPivot('id', 'tipo_beneficiario_id', 'tipo_parentesco_id', 'nro_beneficiario', 'created_by', 'modified_by', 'deleted_at', 'deleted_by', 'condicion_iva_id', 'borrado_logico', 'tipo_plan', 'modalidad_contratacion_id', 'plan_beneficios_id', 'codigoSeguridad')
			->withTimestamps();
	}

	public function persona_plan_por_defecto()
	{
		return $this->hasOne(PersonaPlanPorDefecto::class);
	}

	public function plansocials()
	{
		return $this->belongsToMany(Plansocial::class)
			->withPivot('id', 'origenplansocial_id', 'tipo_beneficiario_id', 'tipo_parentesco_id', 'creado_por_id', 'modificado_por_id', 'eliminado_por_id', 'observacion', 'creado_en', 'modificado_en', 'borrado_en', 'fecha_caducidad', 'pension', 'certificado');
	}

	public function persona_tipo_contribuyentes()
	{
		return $this->hasMany(PersonaTipoContribuyente::class);
	}

	public function persona_trabajo()
	{
		return $this->hasOne(PersonaTrabajo::class);
	}

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class, 'persona_usuario_portal', 'persona_id', 'created_by')
			->withPivot('id', 'modified_by', 'usuario_portal_id', 'principal', 'provisorio', 'type', 'borrado_logico', 'modified_at');
	}

	public function usuario_portals()
	{
		return $this->hasMany(UsuarioPortal::class);
	}

	public function persona_viviendas()
	{
		return $this->hasMany(PersonaVivienda::class);
	}

	public function personacuenta()
	{
		return $this->hasMany(Personacuentum::class);
	}

	public function personal()
	{
		return $this->hasOne(Personal::class);
	}
	public function alergias()
	{
		return $this->hasMany(Alergia::class);
	}

	public function medicaciones()
	{
		return $this->hasMany(Medicacion::class);
	}

	public function rud_ruds()
	{
		return $this->hasMany(RudRud::class);
	}

	public function solicitudturnos()
	{
		return $this->hasMany(Solicitudturno::class);
	}

	public function tratamiento_kinesiologia()
	{
		return $this->hasMany(TratamientoKinesiologium::class);
	}

	public function turno_guardia()
	{
		return $this->hasMany(TurnoGuardium::class);
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}

	public function getNombreCompletoAttribute(): string
	{
		if ($this->usar_nombre_alias && !empty($this->nombre_alias)) {
			return $this->nombre_alias;
		}

		// Datos legacy: algunos registros guardan apellido_materno como
		// '-' en vez de vacío/null cuando no hay dato, y eso queda
		// pegado al nombre.Lo tratamos como vacío.
		$apellidoMaterno = trim((string) $this->apellido_materno);

		if ($apellidoMaterno === '-') {
			$apellidoMaterno = '';
		}

		return trim("{$this->nombres} {$this->apellidos} {$apellidoMaterno}");
	}
}