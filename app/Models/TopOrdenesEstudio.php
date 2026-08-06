<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TopOrdenesEstudio
 * 
 * @property int $id
 * @property int $estudio_id
 * @property int $especialidad_id
 * @property string $genero
 * @property int $edad_minima
 * @property int $edad_maxima
 * @property Carbon $created_at
 * @property int|null $cantidad_historica
 * 
 * @property Especialidad $especialidad
 * @property Estudio $estudio
 *
 * @package App\Models
 */
class TopOrdenesEstudio extends Model
{
	protected $table = 'top_ordenes_estudio';
	public $timestamps = false;

	protected $casts = [
		'estudio_id' => 'int',
		'especialidad_id' => 'int',
		'edad_minima' => 'int',
		'edad_maxima' => 'int',
		'cantidad_historica' => 'int'
	];

	protected $fillable = [
		'estudio_id',
		'especialidad_id',
		'genero',
		'edad_minima',
		'edad_maxima',
		'cantidad_historica'
	];

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}
}
