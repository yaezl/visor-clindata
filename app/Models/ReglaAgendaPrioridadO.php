<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaPrioridadO
 * 
 * @property int $id
 * @property int $dias
 * @property int $cantidad
 * 
 * @property ReglaAgenda $regla_agenda
 * @property Collection|ReglaprioridadObrassociale[] $reglaprioridad_obrassociales
 *
 * @package App\Models
 */
class ReglaAgendaPrioridadO extends Model
{
	protected $table = 'regla_agenda_prioridad_os';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'dias' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'dias',
		'cantidad'
	];

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}

	public function reglaprioridad_obrassociales()
	{
		return $this->hasMany(ReglaprioridadObrassociale::class, 'regla');
	}
}
