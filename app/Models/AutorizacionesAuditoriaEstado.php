<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesAuditoriaEstado
 * 
 * @property int $id
 * @property int|null $autorizacion_id
 * @property int|null $estado_id
 * @property int|null $created_by
 * @property Carbon $created_at
 * @property int|null $aprobacion_id
 * @property int|null $prestador_id
 * @property int|null $tipo_prestacion_id
 * @property int|null $institucion_destino_id
 * @property bool|null $prestador_eliminado
 * @property bool|null $destino_eliminado
 * 
 * @property AutorizacionesTipoPrestacion|null $autorizaciones_tipo_prestacion
 * @property AutorizacionesAutorizacion|null $autorizaciones_autorizacion
 * @property AutorizacionesEstado|null $autorizaciones_estado
 * @property Prestador|null $prestador
 * @property AutorizacionesAprobacion|null $autorizaciones_aprobacion
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property Collection|AuditoriaEstudio[] $auditoria_estudios
 * @property Collection|AuditoriaMedicamento[] $auditoria_medicamentos
 *
 * @package App\Models
 */
class AutorizacionesAuditoriaEstado extends Model
{
	protected $table = 'autorizaciones_auditoria_estado';
	public $timestamps = false;

	protected $casts = [
		'autorizacion_id' => 'int',
		'estado_id' => 'int',
		'created_by' => 'int',
		'aprobacion_id' => 'int',
		'prestador_id' => 'int',
		'tipo_prestacion_id' => 'int',
		'institucion_destino_id' => 'int',
		'prestador_eliminado' => 'bool',
		'destino_eliminado' => 'bool'
	];

	protected $fillable = [
		'autorizacion_id',
		'estado_id',
		'created_by',
		'aprobacion_id',
		'prestador_id',
		'tipo_prestacion_id',
		'institucion_destino_id',
		'prestador_eliminado',
		'destino_eliminado'
	];

	public function autorizaciones_tipo_prestacion()
	{
		return $this->belongsTo(AutorizacionesTipoPrestacion::class, 'tipo_prestacion_id');
	}

	public function autorizaciones_autorizacion()
	{
		return $this->belongsTo(AutorizacionesAutorizacion::class, 'autorizacion_id');
	}

	public function autorizaciones_estado()
	{
		return $this->belongsTo(AutorizacionesEstado::class, 'estado_id');
	}

	public function prestador()
	{
		return $this->belongsTo(Prestador::class);
	}

	public function autorizaciones_aprobacion()
	{
		return $this->belongsTo(AutorizacionesAprobacion::class, 'aprobacion_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class, 'institucion_destino_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function auditoria_estudios()
	{
		return $this->hasMany(AuditoriaEstudio::class, 'auditoria_id');
	}

	public function auditoria_medicamentos()
	{
		return $this->hasMany(AuditoriaMedicamento::class, 'auditoria_id');
	}
}
