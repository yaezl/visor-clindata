<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarEstadoSolicitud
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
 * @property Collection|FarPedidoAlmacen[] $far_pedido_almacens
 * @property Collection|FarSolicitudMedicamento[] $far_solicitud_medicamentos
 *
 * @package App\Models
 */
class FarEstadoSolicitud extends Model
{
	protected $table = 'far_estado_solicitud';
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

	public function far_pedido_almacens()
	{
		return $this->hasMany(FarPedidoAlmacen::class, 'estado_id');
	}

	public function far_solicitud_medicamentos()
	{
		return $this->hasMany(FarSolicitudMedicamento::class, 'estado_id');
	}
}
