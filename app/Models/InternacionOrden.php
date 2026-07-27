<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionOrden
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property int|null $estado_orden_id
 * @property int|null $personal_id
 * @property bool $borrado_logico
 * @property string|null $observacion
 * @property string|null $observacion_estado
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property string $dtype
 * @property bool $requiere_autorizacion
 * @property string|null $nro_autorizacion
 * @property int|null $procedimiento_id
 * @property int|null $sede_internacion_id
 * @property Carbon|null $fecha_orden_programada
 * @property bool $quirurgico
 * @property bool $disponible
 * @property string|null $codigo_ad_hoc
 * 
 * @property InternacionProcedimiento|null $internacion_procedimiento
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property InternacionEstadoOrden|null $internacion_estado_orden
 * @property Personal|null $personal
 * @property Collection|DeclaracionEtiqueta[] $declaracion_etiquetas
 * @property Collection|Derivacion[] $derivacions
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 * @property InternacionOrdenProgramada|null $internacion_orden_programada
 * @property InternacionOrdenUrgente|null $internacion_orden_urgente
 * @property Collection|OrdeninternacionEtiquetum[] $ordeninternacion_etiqueta
 * @property ReservaQuirofano|null $reserva_quirofano
 *
 * @package App\Models
 */
class InternacionOrden extends Model
{
	protected $table = 'internacion_orden';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'estado_orden_id' => 'int',
		'personal_id' => 'int',
		'borrado_logico' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'requiere_autorizacion' => 'bool',
		'procedimiento_id' => 'int',
		'sede_internacion_id' => 'int',
		'fecha_orden_programada' => 'datetime',
		'quirurgico' => 'bool',
		'disponible' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'estado_orden_id',
		'personal_id',
		'borrado_logico',
		'observacion',
		'observacion_estado',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'dtype',
		'requiere_autorizacion',
		'nro_autorizacion',
		'procedimiento_id',
		'sede_internacion_id',
		'fecha_orden_programada',
		'quirurgico',
		'disponible',
		'codigo_ad_hoc'
	];

	public function internacion_procedimiento()
	{
		return $this->belongsTo(InternacionProcedimiento::class, 'procedimiento_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class, 'sede_internacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_estado_orden()
	{
		return $this->belongsTo(InternacionEstadoOrden::class, 'estado_orden_id');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function declaracion_etiquetas()
	{
		return $this->hasMany(DeclaracionEtiqueta::class, 'orden_id');
	}

	public function derivacions()
	{
		return $this->hasMany(Derivacion::class, 'internacion_id');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'orden_internacion_id');
	}

	public function internacion_orden_programada()
	{
		return $this->hasOne(InternacionOrdenProgramada::class, 'id');
	}

	public function internacion_orden_urgente()
	{
		return $this->hasOne(InternacionOrdenUrgente::class, 'id');
	}

	public function ordeninternacion_etiqueta()
	{
		return $this->hasMany(OrdeninternacionEtiquetum::class, 'orden_internacion_id');
	}

	public function reserva_quirofano()
	{
		return $this->hasOne(ReservaQuirofano::class, 'ordenProgramda_id');
	}
}
