<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Envioaalmacen
 * 
 * @property int $id
 * @property Carbon $fecha
 * @property string|null $observaciones
 * 
 * @property Documento $documento
 * @property Collection|FarDetalleHojaPedido[] $far_detalle_hoja_pedidos
 * @property Collection|FarDetalleHojaSolicitud[] $far_detalle_hoja_solicituds
 *
 * @package App\Models
 */
class Envioaalmacen extends Model
{
	protected $table = 'envioaalmacen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'observaciones'
	];

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function far_detalle_hoja_pedidos()
	{
		return $this->hasMany(FarDetalleHojaPedido::class, 'envio_almacen_id');
	}

	public function far_detalle_hoja_solicituds()
	{
		return $this->hasMany(FarDetalleHojaSolicitud::class, 'envio_almacen_id');
	}
}
