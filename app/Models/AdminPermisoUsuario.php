<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPermisoUsuario
 * 
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $permiso_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * 
 * @property Usuario|null $usuario
 * @property Permiso|null $permiso
 * @property Collection|Almacen[] $almacens
 *
 * @package App\Models
 */
class AdminPermisoUsuario extends Model
{
	protected $table = 'admin_permiso_usuario';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'permiso_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'permiso_id',
		'creado_por_id',
		'modificado_por_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class);
	}

	public function almacens()
	{
		return $this->belongsToMany(Almacen::class, 'admin_permiso_usuario_almacen', 'permiso_usuario_id');
	}
}
