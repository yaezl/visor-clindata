<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaEdad
 * 
 * @property int $id
 * 
 * @property ReglaAgenda $regla_agenda
 * @property Collection|RangoEdadRegla[] $rango_edad_reglas
 *
 * @package App\Models
 */
class ReglaAgendaEdad extends Model
{
	protected $table = 'regla_agenda_edad';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}

	public function rango_edad_reglas()
	{
		return $this->hasMany(RangoEdadRegla::class, 'regla_agenda_id');
	}
}
