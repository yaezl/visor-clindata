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
 * Class ObraSocial
 * 
 * @property int $id
 * @property int|null $direccion_id
 * @property int|null $direccion_cobranza_id
 * @property int|null $direccion_facturacion_id
 * @property int|null $cuenta_id
 * @property string $nombre
 * @property string $telefono
 * @property string $cuit
 * @property string $iva
 * @property string $codigo_rnos
 * @property string $email
 * @property string $nombre_contacto
 * @property string $email_contacto
 * @property string $telefono_contacto
 * @property string $fax_contacto
 * @property string $oficina_contacto
 * @property string $observaciones
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string $denominacion
 * @property int|null $categoriaobrasocial_id
 * @property bool $borrado_logico
 * @property string $nombre_en_factura
 * @property string|null $observacion_alerta
 * @property int|null $tratamiento_impositivo_id
 * @property string|null $codigo_ad_hoc
 * @property int|null $diasVigenciaOrden
 * @property bool $es_no_editable
 * @property int|null $consultas_mes
 * @property int|null $consultas_dia
 * @property string $codigoFacturaDoc
 * @property string $codigoSiteds
 * @property bool $informa_vacunas
 * @property bool $requiereEspecialidad
 * @property float|null $IIBBCABA
 * @property float|null $IIBBBA
 * @property float|null $PercepcionIVA
 * @property int|null $logo_id
 * @property string $observacion_alerta_his
 * @property bool $factura_simultaneo
 * @property string|null $nombreEnRecetaElec
 * 
 * @property TratamientoImpositivo|null $tratamiento_impositivo
 * @property Archivo|null $archivo
 * @property Direccion|null $direccion
 * @property Cuentum|null $cuentum
 * @property Categoriaobrasocial|null $categoriaobrasocial
 * @property Collection|BrokerConfig[] $broker_configs
 * @property Collection|CostoPacienteMe[] $costo_paciente_mes
 * @property Collection|ModalidadCoberturaSited[] $modalidad_cobertura_siteds
 * @property Collection|Obrasocialcuentum[] $obrasocialcuenta
 * @property Collection|Plan[] $plans
 * @property Collection|ReglaprioridadObrassociale[] $reglaprioridad_obrassociales
 * @property TarjetaPortal|null $tarjeta_portal
 * @property Collection|TributoObrasocial[] $tributo_obrasocials
 *
 * @package App\Models
 */
class ObraSocial extends Model
{
	use SoftDeletes;
	protected $table = 'obra_social';

	protected $casts = [
		'direccion_id' => 'int',
		'direccion_cobranza_id' => 'int',
		'direccion_facturacion_id' => 'int',
		'cuenta_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'categoriaobrasocial_id' => 'int',
		'borrado_logico' => 'bool',
		'tratamiento_impositivo_id' => 'int',
		'diasVigenciaOrden' => 'int',
		'es_no_editable' => 'bool',
		'consultas_mes' => 'int',
		'consultas_dia' => 'int',
		'informa_vacunas' => 'bool',
		'requiereEspecialidad' => 'bool',
		'IIBBCABA' => 'float',
		'IIBBBA' => 'float',
		'PercepcionIVA' => 'float',
		'logo_id' => 'int',
		'factura_simultaneo' => 'bool'
	];

	protected $fillable = [
		'direccion_id',
		'direccion_cobranza_id',
		'direccion_facturacion_id',
		'cuenta_id',
		'nombre',
		'telefono',
		'cuit',
		'iva',
		'codigo_rnos',
		'email',
		'nombre_contacto',
		'email_contacto',
		'telefono_contacto',
		'fax_contacto',
		'oficina_contacto',
		'observaciones',
		'created_by',
		'modified_by',
		'deleted_by',
		'denominacion',
		'categoriaobrasocial_id',
		'borrado_logico',
		'nombre_en_factura',
		'observacion_alerta',
		'tratamiento_impositivo_id',
		'codigo_ad_hoc',
		'diasVigenciaOrden',
		'es_no_editable',
		'consultas_mes',
		'consultas_dia',
		'codigoFacturaDoc',
		'codigoSiteds',
		'informa_vacunas',
		'requiereEspecialidad',
		'IIBBCABA',
		'IIBBBA',
		'PercepcionIVA',
		'logo_id',
		'observacion_alerta_his',
		'factura_simultaneo',
		'nombreEnRecetaElec'
	];

	public function tratamiento_impositivo()
	{
		return $this->belongsTo(TratamientoImpositivo::class);
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class, 'logo_id');
	}

	public function direccion()
	{
		return $this->belongsTo(Direccion::class, 'direccion_facturacion_id');
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'cuenta_id');
	}

	public function categoriaobrasocial()
	{
		return $this->belongsTo(Categoriaobrasocial::class);
	}

	public function broker_configs()
	{
		return $this->hasMany(BrokerConfig::class);
	}

	public function costo_paciente_mes()
	{
		return $this->hasMany(CostoPacienteMe::class);
	}

	public function modalidad_cobertura_siteds()
	{
		return $this->hasMany(ModalidadCoberturaSited::class, 'obra_social');
	}

	public function obrasocialcuenta()
	{
		return $this->hasMany(Obrasocialcuentum::class, 'obrasocial_id');
	}

	public function plans()
	{
		return $this->hasMany(Plan::class);
	}

	public function reglaprioridad_obrassociales()
	{
		return $this->hasMany(ReglaprioridadObrassociale::class, 'obra_social');
	}

	public function tarjeta_portal()
	{
		return $this->hasOne(TarjetaPortal::class);
	}

	public function tributo_obrasocials()
	{
		return $this->hasMany(TributoObrasocial::class, 'obrasocial_id');
	}
}
