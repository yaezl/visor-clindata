<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarHojaPedido
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $estado_id
 * @property int|null $turno_id
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_fin
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon $fecha_pedido
 * @property string $observaciones
 * @property int|null $institucion_id
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property FarEstadoHojaSolicitud|null $far_estado_hoja_solicitud
 * @property AdminTurnoEnfermerium|null $admin_turno_enfermerium
 * @property Collection|FarDetalleHojaPedido[] $far_detalle_hoja_pedidos
 *
 * @package App\Models
 */
class FarHojaPedido extends Model
{
	protected $table = 'far_hoja_pedido';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'estado_id' => 'int',
		'turno_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'fecha_pedido' => 'datetime',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'estado_id',
		'turno_id',
		'fecha_inicio',
		'fecha_fin',
		'creado_en',
		'modificado_en',
		'fecha_pedido',
		'observaciones',
		'institucion_id'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_estado_hoja_solicitud()
	{
		return $this->belongsTo(FarEstadoHojaSolicitud::class, 'estado_id');
	}

	public function admin_turno_enfermerium()
	{
		return $this->belongsTo(AdminTurnoEnfermerium::class, 'turno_id');
	}

	public function far_detalle_hoja_pedidos()
	{
		return $this->hasMany(FarDetalleHojaPedido::class, 'hoja_pedido_id');
	}
}
