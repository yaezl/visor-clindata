<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaprioridadObrassociale
 * 
 * @property int $regla
 * @property int $obra_social
 * 
 * @property ReglaAgendaPrioridadO $regla_agenda_prioridad_o
 *
 * @package App\Models
 */
class ReglaprioridadObrassociale extends Model
{
	protected $table = 'reglaprioridad_obrassociales';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'regla' => 'int',
		'obra_social' => 'int'
	];

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class, 'obra_social');
	}

	public function regla_agenda_prioridad_o()
	{
		return $this->belongsTo(ReglaAgendaPrioridadO::class, 'regla');
	}
}
