<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Articuloprescripto
 * 
 * @property int $id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $consulta_id
 * @property int|null $via_administracion_id
 * @property int|null $frecuencia_id
 * @property float $cantidad
 * @property int|null $duracion_cantidad
 * @property int|null $frecuencia_cantidad
 * @property bool $escronico
 * @property string|null $observacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property bool $borrado_logico
 * @property int|null $origen_atencion_id
 * @property float|null $cantidad_indicacion
 * @property Carbon|null $hora
 * @property Carbon|null $unica_dosis
 * @property int|null $unidadMedida_id
 * @property int|null $receta_id
 * 
 * @property Hcrecetum|null $hcrecetum
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Consultum|null $consultum
 * @property Viaadministracion|null $viaadministracion
 * @property Frecuencium|null $frecuencium
 * @property Usuario|null $usuario
 * @property Tipounidadmedida|null $tipounidadmedida
 * @property AdminOrigenAtencion|null $admin_origen_atencion
 * @property Collection|AuditoriaMedicamento[] $auditoria_medicamentos
 * @property Collection|FarDetalleSolicitud[] $far_detalle_solicituds
 *
 * @package App\Models
 */
class Articuloprescripto extends Model
{
	protected $table = 'articuloprescripto';
	public $timestamps = false;

	protected $casts = [
		'articulotipopresentacion_id' => 'int',
		'consulta_id' => 'int',
		'via_administracion_id' => 'int',
		'frecuencia_id' => 'int',
		'cantidad' => 'float',
		'duracion_cantidad' => 'int',
		'frecuencia_cantidad' => 'int',
		'escronico' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'borrado_logico' => 'bool',
		'origen_atencion_id' => 'int',
		'cantidad_indicacion' => 'float',
		'hora' => 'datetime',
		'unica_dosis' => 'datetime',
		'unidadMedida_id' => 'int',
		'receta_id' => 'int'
	];

	protected $fillable = [
		'articulotipopresentacion_id',
		'consulta_id',
		'via_administracion_id',
		'frecuencia_id',
		'cantidad',
		'duracion_cantidad',
		'frecuencia_cantidad',
		'escronico',
		'observacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'borrado_logico',
		'origen_atencion_id',
		'cantidad_indicacion',
		'hora',
		'unica_dosis',
		'unidadMedida_id',
		'receta_id'
	];

	public function hcrecetum()
	{
		return $this->belongsTo(Hcrecetum::class, 'receta_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}

	public function viaadministracion()
	{
		return $this->belongsTo(Viaadministracion::class, 'via_administracion_id');
	}

	public function frecuencium()
	{
		return $this->belongsTo(Frecuencium::class, 'frecuencia_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function tipounidadmedida()
	{
		return $this->belongsTo(Tipounidadmedida::class, 'unidadMedida_id');
	}

	public function admin_origen_atencion()
	{
		return $this->belongsTo(AdminOrigenAtencion::class, 'origen_atencion_id');
	}

	public function auditoria_medicamentos()
	{
		return $this->hasMany(AuditoriaMedicamento::class, 'articulo_prescripto_id');
	}

	public function far_detalle_solicituds()
	{
		return $this->hasMany(FarDetalleSolicitud::class, 'prescripcion_id');
	}
}
