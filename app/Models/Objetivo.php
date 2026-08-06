<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Objetivo
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property string|null $codigo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property Collection|DermatologiaObjetivo[] $dermatologia_objetivos
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Objetivo extends Model
{
	protected $table = 'objetivo';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'codigo',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function dermatologia_objetivos()
	{
		return $this->hasMany(DermatologiaObjetivo::class);
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'persona_objetivo')
					->withPivot('id');
	}
}
