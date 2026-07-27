<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pai
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * @property string|null $prefijo_telefonico
 * @property string|null $codigo_tango
 * 
 * @property Collection|Direccion[] $direccions
 * @property Collection|Institucion[] $institucions
 * @property Collection|Persona[] $personas
 * @property Collection|Provincium[] $provincia
 * @property Collection|UsuarioPortalCelular[] $usuario_portal_celulars
 *
 * @package App\Models
 */
class Pai extends Model
{
	use SoftDeletes;
	protected $table = 'pais';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo',
		'prefijo_telefonico',
		'codigo_tango'
	];

	public function direccions()
	{
		return $this->hasMany(Direccion::class, 'pais_id');
	}

	public function institucions()
	{
		return $this->hasMany(Institucion::class, 'pais_id');
	}

	public function personas()
	{
		return $this->hasMany(Persona::class, 'pais_id');
	}

	public function provincia()
	{
		return $this->hasMany(Provincium::class, 'pais_id');
	}

	public function usuario_portal_celulars()
	{
		return $this->hasMany(UsuarioPortalCelular::class, 'pais_id');
	}
}
