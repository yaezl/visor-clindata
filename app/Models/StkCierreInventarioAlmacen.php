<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkCierreInventarioAlmacen
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
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class StkCierreInventarioAlmacen extends Model
{
	protected $table = 'stk_cierre_inventario_almacen';
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

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}
}
