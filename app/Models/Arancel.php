<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Arancel
 * 
 * @property int $id
 * @property int|null $parent_id
 * @property string $nombre
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property bool $borrado_logico
 * 
 * @property Arancel|null $arancel
 * @property Nomenclable $nomenclable
 * @property Collection|Arancel[] $arancels
 * @property Collection|ArancelCategorium[] $arancel_categoria
 * @property Collection|Cotizacion[] $cotizacions
 * @property Collection|Factorcorreccion[] $factorcorreccions
 * @property Collection|ItemArancelPrecio[] $item_arancel_precios
 * @property Collection|Prestacion[] $prestacions
 *
 * @package App\Models
 */
class Arancel extends Model
{
	protected $table = 'arancel';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'parent_id' => 'int',
		'root' => 'int',
		'lft' => 'int',
		'rgt' => 'int',
		'lvl' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'parent_id',
		'nombre',
		'root',
		'lft',
		'rgt',
		'lvl',
		'borrado_logico'
	];

	public function arancel()
	{
		return $this->belongsTo(Arancel::class, 'parent_id');
	}

	public function nomenclable()
	{
		return $this->belongsTo(Nomenclable::class, 'id');
	}

	public function arancels()
	{
		return $this->hasMany(Arancel::class, 'parent_id');
	}

	public function arancel_categoria()
	{
		return $this->hasMany(ArancelCategorium::class);
	}

	public function cotizacions()
	{
		return $this->belongsToMany(Cotizacion::class, 'cotizacion_aranceles_precio')
					->withPivot('id', 'created_by', 'precio');
	}

	public function factorcorreccions()
	{
		return $this->hasMany(Factorcorreccion::class);
	}

	public function item_arancel_precios()
	{
		return $this->hasMany(ItemArancelPrecio::class);
	}

	public function prestacions()
	{
		return $this->belongsToMany(Prestacion::class, 'prestacion_arancel')
					->withPivot('id');
	}
}
