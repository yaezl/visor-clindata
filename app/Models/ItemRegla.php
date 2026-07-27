<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemRegla
 * 
 * @property int $id
 * @property bool $reintegrable
 * @property bool $requiereAutorizacion
 * @property bool $requiereOrden
 * @property bool $requiereInforme
 * @property bool $requiereValidacion
 * @property bool $permiteIgnorarReglasCobro
 * @property bool $validoCpm
 * @property float $porcentajeIva
 * @property bool $noConvenida
 * @property bool $permiteAgregarIva
 * 
 * @property Collection|ItemBono[] $item_bonos
 *
 * @package App\Models
 */
class ItemRegla extends Model
{
	protected $table = 'itemReglas';
	public $timestamps = false;

	protected $casts = [
		'reintegrable' => 'bool',
		'requiereAutorizacion' => 'bool',
		'requiereOrden' => 'bool',
		'requiereInforme' => 'bool',
		'requiereValidacion' => 'bool',
		'permiteIgnorarReglasCobro' => 'bool',
		'validoCpm' => 'bool',
		'porcentajeIva' => 'float',
		'noConvenida' => 'bool',
		'permiteAgregarIva' => 'bool'
	];

	protected $fillable = [
		'reintegrable',
		'requiereAutorizacion',
		'requiereOrden',
		'requiereInforme',
		'requiereValidacion',
		'permiteIgnorarReglasCobro',
		'validoCpm',
		'porcentajeIva',
		'noConvenida',
		'permiteAgregarIva'
	];

	public function item_bonos()
	{
		return $this->hasMany(ItemBono::class, 'reglas');
	}
}
