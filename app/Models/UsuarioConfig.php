<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioConfig
 * 
 * @property int $id
 * @property int $usuario_id
 * @property string $config
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class UsuarioConfig extends Model
{
	protected $table = 'usuario_config';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'config'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
