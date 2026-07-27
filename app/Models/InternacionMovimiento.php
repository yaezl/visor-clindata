<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionMovimiento
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property int|null $siguiente_evento_id
 * @property int|null $persona_internacion_id
 * @property int|null $cama_id
 * @property int $tipo_evento_id
 * @property int|null $tipo_egreso_id
 * @property int|null $origen_id
 * @property int|null $destino_id
 * @property int|null $motivo_suspension_id
 * @property int|null $orden_internacion_id
 * @property Carbon|null $fecha_hora_evento
 * @property bool $borrado_logico
 * @property string|null $nota
 * @property string|null $observacion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $evento_obstetrico_id
 * @property int|null $defuncion_id
 * @property int|null $tipo_alta_id
 * @property string|null $observaciones_alta
 * @property string|null $procedimientos_quirurgicos
 * @property string $status
 * 
 * @property InternacionDefuncion|null $internacion_defuncion
 * @property InternacionEventoObstetrico|null $internacion_evento_obstetrico
 * @property InternacionTipoAltum|null $internacion_tipo_altum
 * @property Usuario|null $usuario
 * @property InternacionServicio|null $internacion_servicio
 * @property InternacionMotivoSuspension|null $internacion_motivo_suspension
 * @property InternacionOrden|null $internacion_orden
 * @property InternacionMovimiento|null $internacion_movimiento
 * @property InternacionPersona|null $internacion_persona
 * @property InternacionCama|null $internacion_cama
 * @property InternacionTipoEvento $internacion_tipo_evento
 * @property InternacionTipoEgreso|null $internacion_tipo_egreso
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 * @property Collection|MovimientoInternacionDiagnostico[] $movimiento_internacion_diagnosticos
 *
 * @package App\Models
 */
class InternacionMovimiento extends Model
{
	protected $table = 'internacion_movimiento';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'siguiente_evento_id' => 'int',
		'persona_internacion_id' => 'int',
		'cama_id' => 'int',
		'tipo_evento_id' => 'int',
		'tipo_egreso_id' => 'int',
		'origen_id' => 'int',
		'destino_id' => 'int',
		'motivo_suspension_id' => 'int',
		'orden_internacion_id' => 'int',
		'fecha_hora_evento' => 'datetime',
		'borrado_logico' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'evento_obstetrico_id' => 'int',
		'defuncion_id' => 'int',
		'tipo_alta_id' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'siguiente_evento_id',
		'persona_internacion_id',
		'cama_id',
		'tipo_evento_id',
		'tipo_egreso_id',
		'origen_id',
		'destino_id',
		'motivo_suspension_id',
		'orden_internacion_id',
		'fecha_hora_evento',
		'borrado_logico',
		'nota',
		'observacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'evento_obstetrico_id',
		'defuncion_id',
		'tipo_alta_id',
		'observaciones_alta',
		'procedimientos_quirurgicos',
		'status'
	];

	public function internacion_defuncion()
	{
		return $this->belongsTo(InternacionDefuncion::class, 'defuncion_id');
	}

	public function internacion_evento_obstetrico()
	{
		return $this->belongsTo(InternacionEventoObstetrico::class, 'evento_obstetrico_id');
	}

	public function internacion_tipo_altum()
	{
		return $this->belongsTo(InternacionTipoAltum::class, 'tipo_alta_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_servicio()
	{
		return $this->belongsTo(InternacionServicio::class, 'origen_id');
	}

	public function internacion_motivo_suspension()
	{
		return $this->belongsTo(InternacionMotivoSuspension::class, 'motivo_suspension_id');
	}

	public function internacion_orden()
	{
		return $this->belongsTo(InternacionOrden::class, 'orden_internacion_id');
	}

	public function internacion_movimiento()
	{
		return $this->belongsTo(InternacionMovimiento::class, 'siguiente_evento_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function internacion_cama()
	{
		return $this->belongsTo(InternacionCama::class, 'cama_id');
	}

	public function internacion_tipo_evento()
	{
		return $this->belongsTo(InternacionTipoEvento::class, 'tipo_evento_id');
	}

	public function internacion_tipo_egreso()
	{
		return $this->belongsTo(InternacionTipoEgreso::class, 'tipo_egreso_id');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'siguiente_evento_id');
	}

	public function movimiento_internacion_diagnosticos()
	{
		return $this->hasMany(MovimientoInternacionDiagnostico::class, 'ocupacion_id');
	}
}
