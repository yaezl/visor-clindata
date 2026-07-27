<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestacion
 * 
 * @property int $id
 * @property int|null $parent_id
 * @property string $codigo
 * @property string $nombre
 * @property int $root
 * @property int|null $lft
 * @property int|null $rgt
 * @property int $lvl
 * @property bool $activo
 * @property bool $no_nomenclable
 * @property string|null $observaciones
 * @property int|null $tipoprestacion_id
 * @property bool|null $aplicaIva
 * @property int|null $codigoSat
 * @property int|null $codigoSiteds
 * @property int|null $unidadNegocio_id
 * @property bool $noAplicaRecargos
 * 
 * @property UnidadNegocio|null $unidad_negocio
 * @property Prestacion|null $prestacion
 * @property Nomenclable $nomenclable
 * @property Tipoprestacion|null $tipoprestacion
 * @property Collection|ArticulotpPrestacion[] $articulotp_prestacions
 * @property Collection|Asignacion[] $asignacions
 * @property Collection|AutorizacionesPractica[] $autorizaciones_practicas
 * @property Collection|Cotizacion[] $cotizacions
 * @property Estudio|null $estudio
 * @property Collection|Estudio[] $estudios
 * @property Collection|ItemBono[] $item_bonos
 * @property Collection|ModulosfacturacionPrestacion[] $modulosfacturacion_prestacions
 * @property Collection|Nomenclador[] $nomencladors
 * @property Collection|Plan[] $plans
 * @property Collection|Prestacion[] $prestacions
 * @property Collection|Arancel[] $arancels
 * @property PrestacionAtributo|null $prestacion_atributo
 * @property PrestacionEnfermerium|null $prestacion_enfermerium
 * @property Collection|PrestacionEnfermeriaPrestacion[] $prestacion_enfermeria_prestacions
 * @property Collection|Convenio[] $convenios
 *
 * @package App\Models
 */
class Prestacion extends Model
{
	protected $table = 'prestacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'parent_id' => 'int',
		'root' => 'int',
		'lft' => 'int',
		'rgt' => 'int',
		'lvl' => 'int',
		'activo' => 'bool',
		'no_nomenclable' => 'bool',
		'tipoprestacion_id' => 'int',
		'aplicaIva' => 'bool',
		'codigoSat' => 'int',
		'codigoSiteds' => 'int',
		'unidadNegocio_id' => 'int',
		'noAplicaRecargos' => 'bool'
	];

	protected $fillable = [
		'parent_id',
		'codigo',
		'nombre',
		'root',
		'lft',
		'rgt',
		'lvl',
		'activo',
		'no_nomenclable',
		'observaciones',
		'tipoprestacion_id',
		'aplicaIva',
		'codigoSat',
		'codigoSiteds',
		'unidadNegocio_id',
		'noAplicaRecargos'
	];

	public function unidad_negocio()
	{
		return $this->belongsTo(UnidadNegocio::class);
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class, 'parent_id');
	}

	public function nomenclable()
	{
		return $this->belongsTo(Nomenclable::class, 'id');
	}

	public function tipoprestacion()
	{
		return $this->belongsTo(Tipoprestacion::class);
	}

	public function articulotp_prestacions()
	{
		return $this->hasMany(ArticulotpPrestacion::class);
	}

	public function asignacions()
	{
		return $this->belongsToMany(Asignacion::class, 'asignacion_prestaciones');
	}

	public function autorizaciones_practicas()
	{
		return $this->hasMany(AutorizacionesPractica::class);
	}

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class);
	}

	public function estudio()
	{
		return $this->hasOne(Estudio::class);
	}

	public function estudios()
	{
		return $this->belongsToMany(Estudio::class)
					->withPivot('cantidad', 'id', 'creadopor_id', 'modificadopor_id', 'eliminadopor_id', 'creado_en', 'modificado_en', 'borrado_en', 'institucion_id');
	}

	public function item_bonos()
	{
		return $this->hasMany(ItemBono::class);
	}

	public function modulosfacturacion_prestacions()
	{
		return $this->hasMany(ModulosfacturacionPrestacion::class);
	}

	public function nomencladors()
	{
		return $this->hasMany(Nomenclador::class, 'prestacion_raiz_id');
	}

	public function plans()
	{
		return $this->belongsToMany(Plan::class, 'plan_cantidad_prestaciones')
					->withPivot('id', 'created_by', 'updated_by', 'cantidad_prestaciones', 'borrado_logico')
					->withTimestamps();
	}

	public function prestacions()
	{
		return $this->hasMany(Prestacion::class, 'parent_id');
	}

	public function arancels()
	{
		return $this->belongsToMany(Arancel::class, 'prestacion_arancel')
					->withPivot('id');
	}

	public function prestacion_atributo()
	{
		return $this->hasOne(PrestacionAtributo::class);
	}

	public function prestacion_enfermerium()
	{
		return $this->hasOne(PrestacionEnfermerium::class);
	}

	public function prestacion_enfermeria_prestacions()
	{
		return $this->hasMany(PrestacionEnfermeriaPrestacion::class);
	}

	public function convenios()
	{
		return $this->belongsToMany(Convenio::class, 'registro_cambio_prestacion_convenio')
					->withPivot('id', 'createdBy');
	}
}
