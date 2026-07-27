<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaPlane
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $frasco_id
 * @property string $nota
 * @property Carbon $fecha
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property FarFrascoPlanHidratacion|null $far_frasco_plan_hidratacion
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaPlane extends Model
{
	protected $table = 'internacion_hoja_enfermeria_planes';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'frasco_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'frasco_id',
		'nota',
		'fecha',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_frasco_plan_hidratacion()
	{
		return $this->belongsTo(FarFrascoPlanHidratacion::class, 'frasco_id');
	}
}
