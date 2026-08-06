<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosConfiguracionUsuariosComisionRecepcion
 * 
 * @property int $unidad_requiriente_id
 * @property int $usuario_id
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class SuministrosConfiguracionUsuariosComisionRecepcion extends Model
{
	protected $table = 'suministros_configuracion_usuarios_comision_recepcion';
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
