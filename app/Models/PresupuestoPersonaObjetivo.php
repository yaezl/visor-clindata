<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PresupuestoPersonaObjetivo
 * 
 * @property int $presupuesto_id
 * @property int $persona_objetivo_id
 * 
 * @property Presupuesto $presupuesto
 * @property PersonaObjetivo $persona_objetivo
 *
 * @package App\Models
 */
class PresupuestoPersonaObjetivo extends Model
{
	protected $table = 'presupuesto_persona_objetivo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'presupuesto_id' => 'int',
		'persona_objetivo_id' => 'int'
	];

	public function presupuesto()
	{
		return $this->belongsTo(Presupuesto::class);
	}

	public function persona_objetivo()
	{
		return $this->belongsTo(PersonaObjetivo::class);
	}
}
