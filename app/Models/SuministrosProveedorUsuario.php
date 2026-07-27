<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosProveedorUsuario
 * 
 * @property int $proveedor_id
 * @property int $usuario_id
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class SuministrosProveedorUsuario extends Model
{
	protected $table = 'suministros_proveedor_usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'proveedor_id' => 'int',
		'usuario_id' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
