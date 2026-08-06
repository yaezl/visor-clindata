<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarDetallePedidoAlmacen
 * 
 * @property int $id
 * @property int|null $pedido_almacen_id
 * @property int|null $detalle_hoja_pedido_id
 * @property int|null $atp_id
 * @property Carbon $fecha
 * @property float $cantidad
 * @property bool $activo
 * @property int|null $cancelado_por
 * @property Carbon|null $cancelado_en
 * 
 * @property Usuario|null $usuario
 * @property FarPedidoAlmacen|null $far_pedido_almacen
 * @property FarDetalleHojaPedido|null $far_detalle_hoja_pedido
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 *
 * @package App\Models
 */
class FarDetallePedidoAlmacen extends Model
{
	protected $table = 'far_detalle_pedido_almacen';
	public $timestamps = false;

	protected $casts = [
		'pedido_almacen_id' => 'int',
		'detalle_hoja_pedido_id' => 'int',
		'atp_id' => 'int',
		'fecha' => 'datetime',
		'cantidad' => 'float',
		'activo' => 'bool',
		'cancelado_por' => 'int',
		'cancelado_en' => 'datetime'
	];

	protected $fillable = [
		'pedido_almacen_id',
		'detalle_hoja_pedido_id',
		'atp_id',
		'fecha',
		'cantidad',
		'activo',
		'cancelado_por',
		'cancelado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'cancelado_por');
	}

	public function far_pedido_almacen()
	{
		return $this->belongsTo(FarPedidoAlmacen::class, 'pedido_almacen_id');
	}

	public function far_detalle_hoja_pedido()
	{
		return $this->belongsTo(FarDetalleHojaPedido::class, 'detalle_hoja_pedido_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}
}
