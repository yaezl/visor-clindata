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
 * Class Perfil
 * 
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $activo
 * @property string|null $codigo
 * 
 * @property Collection|PerfilBloqueo[] $perfil_bloqueos
 * @property Collection|Permiso[] $permisos
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Perfil extends Model
{
	use SoftDeletes;
	protected $table = 'perfil';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'created_by',
		'modified_by',
		'deleted_by',
		'activo',
		'codigo'
	];

	public function perfil_bloqueos()
	{
		return $this->hasMany(PerfilBloqueo::class);
	}

	public function permisos()
	{
		return $this->belongsToMany(Permiso::class);
	}

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class);
	}
}
