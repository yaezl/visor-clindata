<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPermisoUsuarioAlmacen
 * 
 * @property int $permiso_usuario_id
 * @property int $almacen_id
 * 
 * @property AdminPermisoUsuario $admin_permiso_usuario
 * @property Almacen $almacen
 *
 * @package App\Models
 */
class AdminPermisoUsuarioAlmacen extends Model
{
	protected $table = 'admin_permiso_usuario_almacen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'permiso_usuario_id' => 'int',
		'almacen_id' => 'int'
	];

	public function admin_permiso_usuario()
	{
		return $this->belongsTo(AdminPermisoUsuario::class, 'permiso_usuario_id');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}
}
