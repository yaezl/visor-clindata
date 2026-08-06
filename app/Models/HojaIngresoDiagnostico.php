<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HojaIngresoDiagnostico
 * 
 * @property int $hoja_ingreso_id
 * @property int $diagnostico_id
 * 
 * @property Diagnostico $diagnostico
 * @property InternacionHojaIngreso $internacion_hoja_ingreso
 *
 * @package App\Models
 */
class HojaIngresoDiagnostico extends Model
{
	protected $table = 'hoja_ingreso_diagnostico';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'hoja_ingreso_id' => 'int',
		'diagnostico_id' => 'int'
	];

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}

	public function internacion_hoja_ingreso()
	{
		return $this->belongsTo(InternacionHojaIngreso::class, 'hoja_ingreso_id');
	}
}
