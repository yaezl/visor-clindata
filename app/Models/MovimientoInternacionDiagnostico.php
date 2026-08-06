<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MovimientoInternacionDiagnostico
 * 
 * @property int $ocupacion_id
 * @property int $diagnostico_id
 * 
 * @property InternacionMovimiento $internacion_movimiento
 * @property Diagnostico $diagnostico
 *
 * @package App\Models
 */
class MovimientoInternacionDiagnostico extends Model
{
	protected $table = 'movimiento_internacion_diagnostico';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ocupacion_id' => 'int',
		'diagnostico_id' => 'int'
	];

	public function internacion_movimiento()
	{
		return $this->belongsTo(InternacionMovimiento::class, 'ocupacion_id');
	}

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}
}
