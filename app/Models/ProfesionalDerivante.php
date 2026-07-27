<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfesionalDerivante
 * 
 * @property int $id
 * @property bool $borrado_logico
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $matricula
 * @property string $tipo_matricula
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property int|null $persona_id
 * @property int $created_by
 * @property int|null $updated_by
 * 
 * @property Usuario $usuario
 * @property Collection|Derivacion[] $derivacions
 *
 * @package App\Models
 */
class ProfesionalDerivante extends Model
{
	protected $table = 'profesional_derivante';

	protected $casts = [
		'borrado_logico' => 'bool',
		'persona_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'borrado_logico',
		'nombres',
		'apellidos',
		'matricula',
		'tipo_matricula',
		'persona_id',
		'created_by',
		'updated_by'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function derivacions()
	{
		return $this->hasMany(Derivacion::class);
	}
}
