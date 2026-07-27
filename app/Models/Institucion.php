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
 * Class Institucion
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $direccion_id
 * @property int|null $pais_id
 * @property string $cuit
 * @property string $telefono
 * @property string $email
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $unidad_programatica_id
 * @property string $referente
 * @property string|null $codigo
 * @property int $tipo_institucion
 * @property string $codigo_institucion
 * @property bool $es_principal
 * @property string|null $url_gmap
 * @property int|null $logo_id
 * @property string $web
 * @property int|null $direccion_facturacion_id
 * @property string|null $ingresos_brutos
 * @property Carbon|null $fecha_inicio_actividad
 * @property int|null $tipo_institucion_id
 * @property string|null $codigo_facturacion
 * @property int|null $moneda_por_defecto_id
 * @property string|null $email_soporte
 * @property bool $borrado_logico
 * @property bool $esAgentePercepcion
 * @property string|null $whatsApp
 * 
 * @property Direccion|null $direccion
 * @property Pai|null $pai
 * @property Moneda|null $moneda
 * @property UnidadProgramatica|null $unidad_programatica
 * @property Archivo|null $archivo
 * @property Collection|Almacen[] $almacens
 * @property Collection|ArticulotpPrestacion[] $articulotp_prestacions
 * @property Collection|Asignacion[] $asignacions
 * @property Collection|AutorizacionesAuditoriaEstado[] $autorizaciones_auditoria_estados
 * @property Collection|Bono[] $bonos
 * @property Collection|BrokerConfig[] $broker_configs
 * @property Collection|Caja[] $cajas
 * @property Collection|Centrodecosto[] $centrodecostos
 * @property Collection|Config[] $configs
 * @property Collection|ConfiguracionCuota[] $configuracion_cuotas
 * @property Collection|Conversion[] $conversions
 * @property Collection|CostoPacienteMe[] $costo_paciente_mes
 * @property Collection|Cotizacion[] $cotizacions
 * @property Collection|DependenciaSubCategorium[] $dependencia_sub_categoria
 * @property Collection|Derivacion[] $derivacions
 * @property Collection|EstudioPrestacion[] $estudio_prestacions
 * @property Collection|Estudioexterno[] $estudioexternos
 * @property Collection|Usuario[] $usuarios
 * @property Collection|Facturacriterio[] $facturacriterios
 * @property Collection|FarCierreInventario[] $far_cierre_inventarios
 * @property Collection|FarHojaPedido[] $far_hoja_pedidos
 * @property Collection|FarHojaSolicitud[] $far_hoja_solicituds
 * @property Collection|InstitucionDerivaAgregada[] $institucion_deriva_agregadas
 * @property Collection|InstitucionDerivaExcluida[] $institucion_deriva_excluidas
 * @property Collection|Institucioncuentum[] $institucioncuenta
 * @property Collection|InternacionOrden[] $internacion_ordens
 * @property Collection|InternacionQuirofano[] $internacion_quirofanos
 * @property Collection|InternacionSala[] $internacion_salas
 * @property Collection|Nomenclable[] $nomenclables
 * @property Organigrama|null $organigrama
 * @property Collection|Organigrama[] $organigramas
 * @property Collection|Personal[] $personals
 * @property Collection|Piso[] $pisos
 * @property Collection|Plan[] $plans
 * @property Collection|Prefactura[] $prefacturas
 * @property Collection|Prestador[] $prestadors
 * @property Collection|ProfesionalPlan[] $profesional_plans
 * @property Collection|Reporteconfig[] $reporteconfigs
 * @property Collection|RudRud[] $rud_ruds
 * @property Collection|Solicitudturno[] $solicitudturnos
 * @property Collection|SuministrosCentroDeCosto[] $suministros_centro_de_costos
 * @property Collection|SuministrosOrdenDeCompra[] $suministros_orden_de_compras
 * @property Collection|SuministrosPersonalCargoProvisorio[] $suministros_personal_cargo_provisorios
 * @property Collection|SuministrosProyecto[] $suministros_proyectos
 * @property Collection|SuministrosSolicitudDeCompra[] $suministros_solicitud_de_compras
 * @property Collection|SuministrosVale[] $suministros_vales
 * @property Collection|TedefLotesFacturacion[] $tedef_lotes_facturacions
 * @property Collection|Turnero[] $turneros
 * @property Collection|TurnoProgramado[] $turno_programados
 * @property Collection|UnidadProgramatica[] $unidad_programaticas
 * @property Collection|UsuarioAlmacen[] $usuario_almacens
 *
 * @package App\Models
 */
class Institucion extends Model
{
	use SoftDeletes;
	protected $table = 'institucion';

	protected $casts = [
		'direccion_id' => 'int',
		'pais_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'unidad_programatica_id' => 'int',
		'tipo_institucion' => 'int',
		'es_principal' => 'bool',
		'logo_id' => 'int',
		'direccion_facturacion_id' => 'int',
		'fecha_inicio_actividad' => 'datetime',
		'tipo_institucion_id' => 'int',
		'moneda_por_defecto_id' => 'int',
		'borrado_logico' => 'bool',
		'esAgentePercepcion' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'direccion_id',
		'pais_id',
		'cuit',
		'telefono',
		'email',
		'created_by',
		'modified_by',
		'deleted_by',
		'unidad_programatica_id',
		'referente',
		'codigo',
		'tipo_institucion',
		'codigo_institucion',
		'es_principal',
		'url_gmap',
		'logo_id',
		'web',
		'direccion_facturacion_id',
		'ingresos_brutos',
		'fecha_inicio_actividad',
		'tipo_institucion_id',
		'codigo_facturacion',
		'moneda_por_defecto_id',
		'email_soporte',
		'borrado_logico',
		'esAgentePercepcion',
		'whatsApp'
	];

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}

	public function tipo_institucion()
	{
		return $this->belongsTo(TipoInstitucion::class);
	}

	public function pai()
	{
		return $this->belongsTo(Pai::class, 'pais_id');
	}

	public function moneda()
	{
		return $this->belongsTo(Moneda::class, 'moneda_por_defecto_id');
	}

	public function unidad_programatica()
	{
		return $this->belongsTo(UnidadProgramatica::class);
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class, 'logo_id');
	}

	public function almacens()
	{
		return $this->hasMany(Almacen::class);
	}

	public function articulotp_prestacions()
	{
		return $this->hasMany(ArticulotpPrestacion::class);
	}

	public function asignacions()
	{
		return $this->hasMany(Asignacion::class);
	}

	public function autorizaciones_auditoria_estados()
	{
		return $this->hasMany(AutorizacionesAuditoriaEstado::class, 'institucion_destino_id');
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class);
	}

	public function broker_configs()
	{
		return $this->hasMany(BrokerConfig::class);
	}

	public function cajas()
	{
		return $this->hasMany(Caja::class);
	}

	public function centrodecostos()
	{
		return $this->hasMany(Centrodecosto::class);
	}

	public function configs()
	{
		return $this->hasMany(Config::class);
	}

	public function configuracion_cuotas()
	{
		return $this->hasMany(ConfiguracionCuota::class);
	}

	public function conversions()
	{
		return $this->hasMany(Conversion::class);
	}

	public function costo_paciente_mes()
	{
		return $this->hasMany(CostoPacienteMe::class);
	}

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class);
	}

	public function dependencia_sub_categoria()
	{
		return $this->hasMany(DependenciaSubCategorium::class);
	}

	public function derivacions()
	{
		return $this->hasMany(Derivacion::class);
	}

	public function estudio_prestacions()
	{
		return $this->hasMany(EstudioPrestacion::class);
	}

	public function estudioexternos()
	{
		return $this->hasMany(Estudioexterno::class);
	}

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class, 'fac_usuario_institucion', 'institucion_id', 'eliminado_por_id')
					->withPivot('id', 'usuario_id', 'creado_por_id', 'modificado_por_id', 'creado_en', 'modificado_en', 'borrado_en', 'borrado_logico');
	}

	public function facturacriterios()
	{
		return $this->hasMany(Facturacriterio::class);
	}

	public function far_cierre_inventarios()
	{
		return $this->hasMany(FarCierreInventario::class);
	}

	public function far_hoja_pedidos()
	{
		return $this->hasMany(FarHojaPedido::class);
	}

	public function far_hoja_solicituds()
	{
		return $this->hasMany(FarHojaSolicitud::class);
	}

	public function institucion_deriva_agregadas()
	{
		return $this->hasMany(InstitucionDerivaAgregada::class);
	}

	public function institucion_deriva_excluidas()
	{
		return $this->hasMany(InstitucionDerivaExcluida::class, 'institucion_excluida_id');
	}

	public function institucioncuenta()
	{
		return $this->hasMany(Institucioncuentum::class);
	}

	public function internacion_ordens()
	{
		return $this->hasMany(InternacionOrden::class, 'sede_internacion_id');
	}

	public function internacion_quirofanos()
	{
		return $this->hasMany(InternacionQuirofano::class);
	}

	public function internacion_salas()
	{
		return $this->hasMany(InternacionSala::class);
	}

	public function nomenclables()
	{
		return $this->belongsToMany(Nomenclable::class, 'nomenclable_institucion')
					->withPivot('id');
	}

	public function organigrama()
	{
		return $this->hasOne(Organigrama::class);
	}

	public function organigramas()
	{
		return $this->hasMany(Organigrama::class, 'institucion_padre_id');
	}

	public function personals()
	{
		return $this->belongsToMany(Personal::class, 'personal_institucion');
	}

	public function pisos()
	{
		return $this->hasMany(Piso::class);
	}

	public function plans()
	{
		return $this->belongsToMany(Plan::class, 'plan_institucion')
					->withPivot('id', 'dias_de_vencimiento', 'es_particular', 'copago_variable', 'es_por_defecto', 'created_by', 'modified_by', 'deleted_at', 'deleted_by', 'borrado_logico', 'planTotem', 'numero_contrato')
					->withTimestamps();
	}

	public function prefacturas()
	{
		return $this->hasMany(Prefactura::class);
	}

	public function prestadors()
	{
		return $this->belongsToMany(Prestador::class, 'prestador_institucion')
					->withPivot('id', 'created_by', 'modified_by', 'nombre', 'modified_at', 'borrado_logico');
	}

	public function profesional_plans()
	{
		return $this->hasMany(ProfesionalPlan::class);
	}

	public function reporteconfigs()
	{
		return $this->hasMany(Reporteconfig::class);
	}

	public function rud_ruds()
	{
		return $this->hasMany(RudRud::class);
	}

	public function solicitudturnos()
	{
		return $this->hasMany(Solicitudturno::class);
	}

	public function suministros_centro_de_costos()
	{
		return $this->hasMany(SuministrosCentroDeCosto::class);
	}

	public function suministros_orden_de_compras()
	{
		return $this->hasMany(SuministrosOrdenDeCompra::class, 'dependencia_id');
	}

	public function suministros_personal_cargo_provisorios()
	{
		return $this->hasMany(SuministrosPersonalCargoProvisorio::class);
	}

	public function suministros_proyectos()
	{
		return $this->hasMany(SuministrosProyecto::class);
	}

	public function suministros_solicitud_de_compras()
	{
		return $this->hasMany(SuministrosSolicitudDeCompra::class, 'dependencia_id');
	}

	public function suministros_vales()
	{
		return $this->hasMany(SuministrosVale::class, 'dependencia_id');
	}

	public function tedef_lotes_facturacions()
	{
		return $this->hasMany(TedefLotesFacturacion::class);
	}

	public function turneros()
	{
		return $this->hasMany(Turnero::class);
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}

	public function unidad_programaticas()
	{
		return $this->belongsToMany(UnidadProgramatica::class, 'unidad_programatica_instituciones');
	}

	public function usuario_almacens()
	{
		return $this->hasMany(UsuarioAlmacen::class);
	}
}
