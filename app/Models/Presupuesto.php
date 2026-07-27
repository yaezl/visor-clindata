<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Presupuesto
 * 
 * @property int $id
 * @property int $created_by
 * @property Carbon $created_at
 * 
 * @property Usuario $usuario
 * @property Collection|PersonaObjetivo[] $persona_objetivos
 *
 * @package App\Models
 */
class Presupuesto extends Model
{
	protected $table = 'presupuesto';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int'
	];

	protected $fillable = [
		'created_by'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function persona_objetivos()
	{
		return $this->belongsToMany(PersonaObjetivo::class, 'presupuesto_persona_objetivo');
	}
}
