<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionEventoObstetrico
 * 
 * @property int $id
 * @property Carbon $fecha_final_embarazo
 * @property int $edad_gestacional
 * @property int $paridad
 * @property string|null $complicaciones
 * 
 * @property InternacionMovimiento|null $internacion_movimiento
 * @property Collection|InternacionProductoEventoObstetrico[] $internacion_producto_evento_obstetricos
 *
 * @package App\Models
 */
class InternacionEventoObstetrico extends Model
{
	protected $table = 'internacion_evento_obstetrico';
	public $timestamps = false;

	protected $casts = [
		'fecha_final_embarazo' => 'datetime',
		'edad_gestacional' => 'int',
		'paridad' => 'int'
	];

	protected $fillable = [
		'fecha_final_embarazo',
		'edad_gestacional',
		'paridad',
		'complicaciones'
	];

	public function internacion_movimiento()
	{
		return $this->hasOne(InternacionMovimiento::class, 'evento_obstetrico_id');
	}

	public function internacion_producto_evento_obstetricos()
	{
		return $this->hasMany(InternacionProductoEventoObstetrico::class, 'evento_obstetrico_id');
	}
}
