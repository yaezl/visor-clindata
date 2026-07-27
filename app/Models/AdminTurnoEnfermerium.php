<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminTurnoEnfermerium
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property Carbon $inicio
 * @property Carbon|null $fin
 * @property string|null $codigo
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property Collection|FarEdicionEnvioSolicitud[] $far_edicion_envio_solicituds
 * @property Collection|FarHojaPedido[] $far_hoja_pedidos
 * @property Collection|FarHojaSolicitud[] $far_hoja_solicituds
 * @property Collection|FarSolicitudTurno[] $far_solicitud_turnos
 *
 * @package App\Models
 */
class AdminTurnoEnfermerium extends Model
{
	protected $table = 'admin_turno_enfermeria';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'inicio' => 'datetime',
		'fin' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'inicio',
		'fin',
		'codigo',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_edicion_envio_solicituds()
	{
		return $this->hasMany(FarEdicionEnvioSolicitud::class, 'turno_id');
	}

	public function far_hoja_pedidos()
	{
		return $this->hasMany(FarHojaPedido::class, 'turno_id');
	}

	public function far_hoja_solicituds()
	{
		return $this->hasMany(FarHojaSolicitud::class, 'turno_id');
	}

	public function far_solicitud_turnos()
	{
		return $this->hasMany(FarSolicitudTurno::class, 'turno_id');
	}
}
