<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RangoEdadRegla
 * 
 * @property int $id
 * @property int|null $regla_agenda_id
 * @property int $edad_minima
 * @property int $edad_maxima
 * 
 * @property ReglaAgendaEdad|null $regla_agenda_edad
 *
 * @package App\Models
 */
class RangoEdadRegla extends Model
{
	protected $table = 'rango_edad_regla';
	public $timestamps = false;

	protected $casts = [
		'regla_agenda_id' => 'int',
		'edad_minima' => 'int',
		'edad_maxima' => 'int'
	];

	protected $fillable = [
		'regla_agenda_id',
		'edad_minima',
		'edad_maxima'
	];

	public function regla_agenda_edad()
	{
		return $this->belongsTo(ReglaAgendaEdad::class, 'regla_agenda_id');
	}
}
