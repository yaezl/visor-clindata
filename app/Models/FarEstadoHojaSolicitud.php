<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarEstadoHojaSolicitud
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property string|null $codigo
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property Collection|FarDetalleHojaPedido[] $far_detalle_hoja_pedidos
 * @property Collection|FarDetalleHojaSolicitud[] $far_detalle_hoja_solicituds
 * @property Collection|FarHojaPedido[] $far_hoja_pedidos
 * @property Collection|FarHojaSolicitud[] $far_hoja_solicituds
 *
 * @package App\Models
 */
class FarEstadoHojaSolicitud extends Model
{
	protected $table = 'far_estado_hoja_solicitud';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'codigo',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_detalle_hoja_pedidos()
	{
		return $this->hasMany(FarDetalleHojaPedido::class, 'estado_id');
	}

	public function far_detalle_hoja_solicituds()
	{
		return $this->hasMany(FarDetalleHojaSolicitud::class, 'estado_id');
	}

	public function far_hoja_pedidos()
	{
		return $this->hasMany(FarHojaPedido::class, 'estado_id');
	}

	public function far_hoja_solicituds()
	{
		return $this->hasMany(FarHojaSolicitud::class, 'estado_id');
	}
}
