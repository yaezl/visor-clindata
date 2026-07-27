<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarSolicitudMedicamento
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $estado_id
 * @property int|null $persona_internacion_id
 * @property Carbon $fecha
 * @property string|null $observaciones
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property FarEstadoSolicitud|null $far_estado_solicitud
 * @property InternacionPersona|null $internacion_persona
 * @property Collection|FarDetalleSolicitud[] $far_detalle_solicituds
 * @property Collection|InternacionFrPhpSolicitudMedicamento[] $internacion_fr_php_solicitud_medicamentos
 * @property InternacionHiSolicitudMedicamento|null $internacion_hi_solicitud_medicamento
 *
 * @package App\Models
 */
class FarSolicitudMedicamento extends Model
{
	protected $table = 'far_solicitud_medicamento';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'estado_id' => 'int',
		'persona_internacion_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'estado_id',
		'persona_internacion_id',
		'fecha',
		'observaciones',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_estado_solicitud()
	{
		return $this->belongsTo(FarEstadoSolicitud::class, 'estado_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function far_detalle_solicituds()
	{
		return $this->hasMany(FarDetalleSolicitud::class, 'solicitud_medicamento_id');
	}

	public function internacion_fr_php_solicitud_medicamentos()
	{
		return $this->hasMany(InternacionFrPhpSolicitudMedicamento::class, 'solicitud_medicamento_id');
	}

	public function internacion_hi_solicitud_medicamento()
	{
		return $this->hasOne(InternacionHiSolicitudMedicamento::class, 'solicitud_medicamento_id');
	}
}
