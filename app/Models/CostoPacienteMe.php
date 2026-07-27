<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CostoPacienteMe
 * 
 * @property int $id
 * @property int|null $obra_social_id
 * @property int|null $institucion_id
 * @property float $monto
 * @property Carbon $inicio_vigencia
 * @property Carbon|null $fin_vigencia
 * @property Carbon $created_at
 * @property int $created_by
 * 
 * @property ObraSocial|null $obra_social
 * @property Institucion|null $institucion
 *
 * @package App\Models
 */
class CostoPacienteMe extends Model
{
	protected $table = 'costo_paciente_mes';
	public $timestamps = false;

	protected $casts = [
		'obra_social_id' => 'int',
		'institucion_id' => 'int',
		'monto' => 'float',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'created_by' => 'int'
	];

	protected $fillable = [
		'obra_social_id',
		'institucion_id',
		'monto',
		'inicio_vigencia',
		'fin_vigencia',
		'created_by'
	];

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
