<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosUnidadRequirienteUsuario
 * 
 * @property int $unidad_requiriente_id
 * @property int $usuario_id
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class SuministrosUnidadRequirienteUsuario extends Model
{
	protected $table = 'suministros_unidad_requiriente_usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'unidad_requiriente_id' => 'int',
		'usuario_id' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
