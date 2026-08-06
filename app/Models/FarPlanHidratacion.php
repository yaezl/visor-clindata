<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarPlanHidratacion
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $hoja_indicaciones_id
 * @property Carbon $fecha
 * @property int $numero
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $unica_vez
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property InternacionHojaIndicacione|null $internacion_hoja_indicacione
 * @property Collection|FarFrascoPlanHidratacion[] $far_frasco_plan_hidratacions
 *
 * @package App\Models
 */
class FarPlanHidratacion extends Model
{
	protected $table = 'far_plan_hidratacion';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'hoja_indicaciones_id' => 'int',
		'fecha' => 'datetime',
		'numero' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'unica_vez' => 'bool',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'hoja_indicaciones_id',
		'fecha',
		'numero',
		'creado_en',
		'modificado_en',
		'unica_vez',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function internacion_hoja_indicacione()
	{
		return $this->belongsTo(InternacionHojaIndicacione::class, 'hoja_indicaciones_id');
	}

	public function far_frasco_plan_hidratacions()
	{
		return $this->hasMany(FarFrascoPlanHidratacion::class, 'plan_hidratacion_id');
	}
}
