<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarFrascoPlanHidratacion
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $atp_id
 * @property int|null $goteo_id
 * @property int|null $plan_hidratacion_id
 * @property int $numero
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * @property string|null $comentario
 * 
 * @property Usuario|null $usuario
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property FarGoteo|null $far_goteo
 * @property FarPlanHidratacion|null $far_plan_hidratacion
 * @property Collection|InternacionFrPhpSolicitudMedicamento[] $internacion_fr_php_solicitud_medicamentos
 * @property Collection|InternacionHojaEnfermeriaPlane[] $internacion_hoja_enfermeria_planes
 *
 * @package App\Models
 */
class FarFrascoPlanHidratacion extends Model
{
	protected $table = 'far_frasco_plan_hidratacion';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'atp_id' => 'int',
		'goteo_id' => 'int',
		'plan_hidratacion_id' => 'int',
		'numero' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'atp_id',
		'goteo_id',
		'plan_hidratacion_id',
		'numero',
		'creado_en',
		'modificado_en',
		'activo',
		'comentario'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}

	public function far_goteo()
	{
		return $this->belongsTo(FarGoteo::class, 'goteo_id');
	}

	public function far_plan_hidratacion()
	{
		return $this->belongsTo(FarPlanHidratacion::class, 'plan_hidratacion_id');
	}

	public function internacion_fr_php_solicitud_medicamentos()
	{
		return $this->hasMany(InternacionFrPhpSolicitudMedicamento::class, 'frasco_php_id');
	}

	public function internacion_hoja_enfermeria_planes()
	{
		return $this->hasMany(InternacionHojaEnfermeriaPlane::class, 'frasco_id');
	}
}
