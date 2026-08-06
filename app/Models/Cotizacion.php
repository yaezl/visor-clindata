<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cotizacion
 * 
 * @property int $id
 * @property int|null $prestacion_id
 * @property int|null $categoria_id
 * @property int|null $nomenclador_id
 * @property float $precio
 * @property float $copago
 * @property Carbon $inicio_vigencia
 * @property Carbon|null $fin_vigencia
 * @property bool $noconvenida
 * @property bool $reintegrable
 * @property bool $copago_variable
 * @property int|null $institucion_id
 * @property int|null $articulotipopresentacion_id
 * @property bool $requiereAutorizacion
 * @property bool $requiereOrden
 * @property bool $permite_ignorar_reglas_cobro
 * @property bool $permite_agregar_iva
 * @property float $porcentaje_iva
 * @property bool $requiereInforme
 * @property bool $requiereValidacion
 * @property bool $uso_unica_vez
 * @property bool|null $esValorDeducible
 * @property int|null $moduloFacturacion_id
 * @property bool $validoCpm
 * 
 * @property ModulosFacturacion|null $modulos_facturacion
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Prestacion|null $prestacion
 * @property Categorium|null $categorium
 * @property Nomenclador|null $nomenclador
 * @property Institucion|null $institucion
 * @property Collection|Bonoitem[] $bonoitems
 * @property Collection|Arancel[] $arancels
 * @property Collection|Prefacturaitem[] $prefacturaitems
 *
 * @package App\Models
 */
class Cotizacion extends Model
{
	protected $table = 'cotizacion';
	public $timestamps = false;

	protected $casts = [
		'prestacion_id' => 'int',
		'categoria_id' => 'int',
		'nomenclador_id' => 'int',
		'precio' => 'float',
		'copago' => 'float',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'noconvenida' => 'bool',
		'reintegrable' => 'bool',
		'copago_variable' => 'bool',
		'institucion_id' => 'int',
		'articulotipopresentacion_id' => 'int',
		'requiereAutorizacion' => 'bool',
		'requiereOrden' => 'bool',
		'permite_ignorar_reglas_cobro' => 'bool',
		'permite_agregar_iva' => 'bool',
		'porcentaje_iva' => 'float',
		'requiereInforme' => 'bool',
		'requiereValidacion' => 'bool',
		'uso_unica_vez' => 'bool',
		'esValorDeducible' => 'bool',
		'moduloFacturacion_id' => 'int',
		'validoCpm' => 'bool'
	];

	protected $fillable = [
		'prestacion_id',
		'categoria_id',
		'nomenclador_id',
		'precio',
		'copago',
		'inicio_vigencia',
		'fin_vigencia',
		'noconvenida',
		'reintegrable',
		'copago_variable',
		'institucion_id',
		'articulotipopresentacion_id',
		'requiereAutorizacion',
		'requiereOrden',
		'permite_ignorar_reglas_cobro',
		'permite_agregar_iva',
		'porcentaje_iva',
		'requiereInforme',
		'requiereValidacion',
		'uso_unica_vez',
		'esValorDeducible',
		'moduloFacturacion_id',
		'validoCpm'
	];

	public function modulos_facturacion()
	{
		return $this->belongsTo(ModulosFacturacion::class, 'moduloFacturacion_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function categorium()
	{
		return $this->belongsTo(Categorium::class, 'categoria_id');
	}

	public function nomenclador()
	{
		return $this->belongsTo(Nomenclador::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function bonoitems()
	{
		return $this->hasMany(Bonoitem::class);
	}

	public function arancels()
	{
		return $this->belongsToMany(Arancel::class, 'cotizacion_aranceles_precio')
					->withPivot('id', 'created_by', 'precio');
	}

	public function prefacturaitems()
	{
		return $this->hasMany(Prefacturaitem::class);
	}
}
