<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilPermiso
 * 
 * @property int $perfil_id
 * @property int $permiso_id
 * 
 * @property Perfil $perfil
 * @property Permiso $permiso
 *
 * @package App\Models
 */
class PerfilPermiso extends Model
{
	protected $table = 'perfil_permiso';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'perfil_id' => 'int',
		'permiso_id' => 'int'
	];

	public function perfil()
	{
		return $this->belongsTo(Perfil::class);
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class);
	}
}
