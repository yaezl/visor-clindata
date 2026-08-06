<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilBloqueo
 * 
 * @property int $bloqueo_id
 * @property int $perfil_id
 * 
 * @property BloqueoFuncione $bloqueo_funcione
 * @property Perfil $perfil
 *
 * @package App\Models
 */
class PerfilBloqueo extends Model
{
	protected $table = 'perfil_bloqueo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'bloqueo_id' => 'int',
		'perfil_id' => 'int'
	];

	public function bloqueo_funcione()
	{
		return $this->belongsTo(BloqueoFuncione::class, 'bloqueo_id');
	}

	public function perfil()
	{
		return $this->belongsTo(Perfil::class);
	}
}
