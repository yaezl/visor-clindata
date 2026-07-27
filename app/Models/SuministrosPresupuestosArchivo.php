<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosPresupuestosArchivo
 * 
 * @property int $presupuesto_id
 * @property int $archivo_id
 * 
 * @property Archivo $archivo
 *
 * @package App\Models
 */
class SuministrosPresupuestosArchivo extends Model
{
	protected $table = 'suministros_presupuestos_archivo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'presupuesto_id' => 'int',
		'archivo_id' => 'int'
	];

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}
}
