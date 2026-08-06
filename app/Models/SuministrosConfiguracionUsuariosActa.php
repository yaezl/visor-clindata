<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosConfiguracionUsuariosActa
 * 
 * @property int $unidad_requiriente_id
 * @property int $usuario_id
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class SuministrosConfiguracionUsuariosActa extends Model
{
	protected $table = 'suministros_configuracion_usuarios_actas';
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
