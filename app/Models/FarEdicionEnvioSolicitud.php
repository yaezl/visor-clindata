<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarEdicionEnvioSolicitud
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $detalle_solicitud_id
 * @property int|null $turno_id
 * @property float $cantidad
 * @property bool $autorizado
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $borrado_logico
 * @property bool $enviado
 * 
 * @property AdminTurnoEnfermerium|null $admin_turno_enfermerium
 * @property Usuario|null $usuario
 * @property FarDetalleSolicitud|null $far_detalle_solicitud
 *
 * @package App\Models
 */
class FarEdicionEnvioSolicitud extends Model
{
	protected $table = 'far_edicion_envio_solicitud';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'detalle_solicitud_id' => 'int',
		'turno_id' => 'int',
		'cantidad' => 'float',
		'autorizado' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'enviado' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'detalle_solicitud_id',
		'turno_id',
		'cantidad',
		'autorizado',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'enviado'
	];

	public function admin_turno_enfermerium()
	{
		return $this->belongsTo(AdminTurnoEnfermerium::class, 'turno_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}

	public function far_detalle_solicitud()
	{
		return $this->belongsTo(FarDetalleSolicitud::class, 'detalle_solicitud_id');
	}
}
