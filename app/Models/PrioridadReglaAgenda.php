<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrioridadReglaAgenda
 * 
 * @property int $id
 * @property int $prioridad
 * 
 * @property Collection|ReglaAgenda[] $regla_agendas
 *
 * @package App\Models
 */
class PrioridadReglaAgenda extends Model
{
	protected $table = 'prioridad_regla_agenda';
	public $timestamps = false;

	protected $casts = [
		'prioridad' => 'int'
	];

	protected $fillable = [
		'prioridad'
	];

	public function regla_agendas()
	{
		return $this->hasMany(ReglaAgenda::class, 'prioridad_id');
	}
}
