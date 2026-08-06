<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarDetalleHojaPedido
 * 
 * @property int $id
 * @property int|null $hoja_pedido_id
 * @property int|null $almacen_id
 * @property int|null $estado_id
 * @property int|null $envio_almacen_id
 * @property int $almacen_origen_id
 * 
 * @property Almacen|null $almacen
 * @property FarHojaPedido|null $far_hoja_pedido
 * @property FarEstadoHojaSolicitud|null $far_estado_hoja_solicitud
 * @property Envioaalmacen|null $envioaalmacen
 * @property Collection|FarDetallePedidoAlmacen[] $far_detalle_pedido_almacens
 *
 * @package App\Models
 */
class FarDetalleHojaPedido extends Model
{
	protected $table = 'far_detalle_hoja_pedido';
	public $timestamps = false;

	protected $casts = [
		'hoja_pedido_id' => 'int',
		'almacen_id' => 'int',
		'estado_id' => 'int',
		'envio_almacen_id' => 'int',
		'almacen_origen_id' => 'int'
	];

	protected $fillable = [
		'hoja_pedido_id',
		'almacen_id',
		'estado_id',
		'envio_almacen_id',
		'almacen_origen_id'
	];

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function far_hoja_pedido()
	{
		return $this->belongsTo(FarHojaPedido::class, 'hoja_pedido_id');
	}

	public function far_estado_hoja_solicitud()
	{
		return $this->belongsTo(FarEstadoHojaSolicitud::class, 'estado_id');
	}

	public function envioaalmacen()
	{
		return $this->belongsTo(Envioaalmacen::class, 'envio_almacen_id');
	}

	public function far_detalle_pedido_almacens()
	{
		return $this->hasMany(FarDetallePedidoAlmacen::class, 'detalle_hoja_pedido_id');
	}
}
