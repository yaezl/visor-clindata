<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaObjetivo
 * 
 * @property int $id
 * @property int $persona_id
 * @property int $objetivo_id
 * 
 * @property Objetivo $objetivo
 * @property Persona $persona
 * @property Collection|Estudio[] $estudios
 * @property Collection|Presupuesto[] $presupuestos
 *
 * @package App\Models
 */
class PersonaObjetivo extends Model
{
	protected $table = 'persona_objetivo';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'objetivo_id' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'objetivo_id'
	];

	public function objetivo()
	{
		return $this->belongsTo(Objetivo::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function estudios()
	{
		return $this->belongsToMany(Estudio::class, 'persona_objetivo_estudios');
	}

	public function presupuestos()
	{
		return $this->belongsToMany(Presupuesto::class, 'presupuesto_persona_objetivo');
	}
}
