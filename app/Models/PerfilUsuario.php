<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilUsuario
 * 
 * @property int $usuario_id
 * @property int $perfil_id
 * 
 * @property Usuario $usuario
 * @property Perfil $perfil
 *
 * @package App\Models
 */
class PerfilUsuario extends Model
{
	protected $table = 'perfil_usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'perfil_id' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function perfil()
	{
		return $this->belongsTo(Perfil::class);
	}
}
