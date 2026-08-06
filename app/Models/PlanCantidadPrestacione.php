<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanCantidadPrestacione
 * 
 * @property int $id
 * @property int $created_by
 * @property int $updated_by
 * @property int $plan_id
 * @property int $prestacion_id
 * @property int $cantidad_prestaciones
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Prestacion $prestacion
 * @property Plan $plan
 *
 * @package App\Models
 */
class PlanCantidadPrestacione extends Model
{
	protected $table = 'plan_cantidad_prestaciones';

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int',
		'plan_id' => 'int',
		'prestacion_id' => 'int',
		'cantidad_prestaciones' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'updated_by',
		'plan_id',
		'prestacion_id',
		'cantidad_prestaciones',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
