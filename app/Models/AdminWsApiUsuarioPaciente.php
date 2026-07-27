<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminWsApiUsuarioPaciente
 * 
 * @property int $id
 * @property int|null $usuario_ws_id
 * @property int|null $paciente_id
 * @property string $api_key
 * @property Carbon $creado_en
 * 
 * @property Usuario|null $usuario
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class AdminWsApiUsuarioPaciente extends Model
{
	protected $table = 'admin_ws_api_usuario_paciente';
	public $timestamps = false;

	protected $casts = [
		'usuario_ws_id' => 'int',
		'paciente_id' => 'int',
		'creado_en' => 'datetime'
	];

	protected $fillable = [
		'usuario_ws_id',
		'paciente_id',
		'api_key',
		'creado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'usuario_ws_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'paciente_id');
	}
}
