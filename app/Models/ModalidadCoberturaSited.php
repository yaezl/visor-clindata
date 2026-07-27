<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ModalidadCoberturaSited
 * 
 * @property int $id
 * @property int $obra_social
 * @property int $producto
 * @property int $empleador
 * @property int $cobertura
 * @property bool $cpm
 * @property float|null $copagoFijo
 * @property float|null $copagoVariable
 * 
 * @property ProductoSited $producto_sited
 * @property CatalogoCoberturasSited $catalogo_coberturas_sited
 *
 * @package App\Models
 */
class ModalidadCoberturaSited extends Model
{
	protected $table = 'modalidad_cobertura_siteds';
	public $timestamps = false;

	protected $casts = [
		'obra_social' => 'int',
		'producto' => 'int',
		'empleador' => 'int',
		'cobertura' => 'int',
		'cpm' => 'bool',
		'copagoFijo' => 'float',
		'copagoVariable' => 'float'
	];

	protected $fillable = [
		'obra_social',
		'producto',
		'empleador',
		'cobertura',
		'cpm',
		'copagoFijo',
		'copagoVariable'
	];

	public function producto_sited()
	{
		return $this->belongsTo(ProductoSited::class, 'producto');
	}

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class, 'obra_social');
	}

	public function catalogo_coberturas_sited()
	{
		return $this->belongsTo(CatalogoCoberturasSited::class, 'cobertura');
	}

	public function empleador()
	{
		return $this->belongsTo(Empleador::class, 'empleador');
	}
}
