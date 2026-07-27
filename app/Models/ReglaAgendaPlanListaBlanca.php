<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaPlanListaBlanca
 * 
 * @property int $id
 * 
 * @property ReglaAgenda $regla_agenda
 * @property Collection|PlanesListaBlanca[] $planes_lista_blancas
 *
 * @package App\Models
 */
class ReglaAgendaPlanListaBlanca extends Model
{
	protected $table = 'regla_agenda_plan_lista_blanca';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}

	public function planes_lista_blancas()
	{
		return $this->hasMany(PlanesListaBlanca::class, 'regla_id');
	}
}
