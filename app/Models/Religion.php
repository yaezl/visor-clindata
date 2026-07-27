<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Religion
 * 
 * @property int $id
 * @property int $created_by
 * @property int|null $modified_by
 * @property string $codigo
 * @property string $descripcion
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Religion extends Model
{
	protected $table = 'religion';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'codigo',
		'descripcion',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function personas()
	{
		return $this->hasMany(Persona::class);
	}
}
