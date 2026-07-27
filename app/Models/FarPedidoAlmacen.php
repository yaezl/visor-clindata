<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarPedidoAlmacen
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $estado_id
 * @property int|null $almacen_id
 * @property Carbon $fecha
 * @property string|null $observaciones
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * @property int|null $almacen_origen_id
 * 
 * @property Almacen|null $almacen
 * @property Usuario|null $usuario
 * @property FarEstadoSolicitud|null $far_estado_solicitud
 * @property Collection|FarDetallePedidoAlmacen[] $far_detalle_pedido_almacens
 *
 * @package App\Models
 */
class FarPedidoAlmacen extends Model
{
	protected $table = 'far_pedido_almacen';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'estado_id' => 'int',
		'almacen_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool',
		'almacen_origen_id' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'estado_id',
		'almacen_id',
		'fecha',
		'observaciones',
		'creado_en',
		'modificado_en',
		'activo',
		'almacen_origen_id'
	];

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_estado_solicitud()
	{
		return $this->belongsTo(FarEstadoSolicitud::class, 'estado_id');
	}

	public function far_detalle_pedido_almacens()
	{
		return $this->hasMany(FarDetallePedidoAlmacen::class, 'pedido_almacen_id');
	}
}
