<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarCierreInventarioAlmacen
 * 
 * @property int $id
 * @property int|null $cierre_inventario_id
 * @property int|null $almacen_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $finalizado
 * 
 * @property FarCierreInventario|null $far_cierre_inventario
 * @property Almacen|null $almacen
 * @property Usuario|null $usuario
 * @property Collection|FarCierreInventarioAtp[] $far_cierre_inventario_atps
 *
 * @package App\Models
 */
class FarCierreInventarioAlmacen extends Model
{
	protected $table = 'far_cierre_inventario_almacen';
	public $timestamps = false;

	protected $casts = [
		'cierre_inventario_id' => 'int',
		'almacen_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'finalizado' => 'bool'
	];

	protected $fillable = [
		'cierre_inventario_id',
		'almacen_id',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'finalizado'
	];

	public function far_cierre_inventario()
	{
		return $this->belongsTo(FarCierreInventario::class, 'cierre_inventario_id');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_cierre_inventario_atps()
	{
		return $this->hasMany(FarCierreInventarioAtp::class, 'cierre_inventario_almacen_id');
	}
}
