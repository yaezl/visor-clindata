<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuentum
 * 
 * @property int $id
 * @property int|null $parent_id
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $dtype
 * 
 * @property Cuentum|null $cuentum
 * @property Almacencuentum|null $almacencuentum
 * @property Collection|Cuentum[] $cuenta
 * @property Empleadorcuentum|null $empleadorcuentum
 * @property Institucioncuentum|null $institucioncuentum
 * @property Collection|Movimiento[] $movimientos
 * @property ObraSocial|null $obra_social
 * @property Obrasocialcuentum|null $obrasocialcuentum
 * @property Persona|null $persona
 * @property Personacuentum|null $personacuentum
 * @property Collection|Prefactura[] $prefacturas
 * @property Prestadorcuentum|null $prestadorcuentum
 * @property Proveedorcuentum|null $proveedorcuentum
 * @property StkAlmacencuentum|null $stk_almacencuentum
 * @property StkProveedorcuentum|null $stk_proveedorcuentum
 *
 * @package App\Models
 */
class Cuentum extends Model
{
	protected $table = 'cuenta';
	public $timestamps = false;

	protected $casts = [
		'parent_id' => 'int',
		'root' => 'int',
		'lft' => 'int',
		'rgt' => 'int',
		'lvl' => 'int'
	];

	protected $fillable = [
		'parent_id',
		'root',
		'lft',
		'rgt',
		'lvl',
		'dtype'
	];

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'parent_id');
	}

	public function almacencuentum()
	{
		return $this->hasOne(Almacencuentum::class, 'id');
	}

	public function cuenta()
	{
		return $this->hasMany(Cuentum::class, 'parent_id');
	}

	public function empleadorcuentum()
	{
		return $this->hasOne(Empleadorcuentum::class, 'id');
	}

	public function institucioncuentum()
	{
		return $this->hasOne(Institucioncuentum::class, 'id');
	}

	public function movimientos()
	{
		return $this->hasMany(Movimiento::class, 'cuenta_credito_id');
	}

	public function obra_social()
	{
		return $this->hasOne(ObraSocial::class, 'cuenta_id');
	}

	public function obrasocialcuentum()
	{
		return $this->hasOne(Obrasocialcuentum::class, 'id');
	}

	public function persona()
	{
		return $this->hasOne(Persona::class, 'cuenta_id');
	}

	public function personacuentum()
	{
		return $this->hasOne(Personacuentum::class, 'id');
	}

	public function prefacturas()
	{
		return $this->hasMany(Prefactura::class, 'cuenta_id');
	}

	public function prestadorcuentum()
	{
		return $this->hasOne(Prestadorcuentum::class, 'id');
	}

	public function proveedorcuentum()
	{
		return $this->hasOne(Proveedorcuentum::class, 'id');
	}

	public function stk_almacencuentum()
	{
		return $this->hasOne(StkAlmacencuentum::class, 'id');
	}

	public function stk_proveedorcuentum()
	{
		return $this->hasOne(StkProveedorcuentum::class, 'id');
	}
}
