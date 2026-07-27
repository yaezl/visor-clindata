<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermisoBloqueoEstudio
 * 
 * @property int $id
 * @property int|null $permiso_id
 * @property int|null $estudio_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * 
 * @property Usuario|null $usuario
 * @property Permiso|null $permiso
 * @property Estudio|null $estudio
 *
 * @package App\Models
 */
class PermisoBloqueoEstudio extends Model
{
	protected $table = 'permiso_bloqueo_estudio';
	public $timestamps = false;

	protected $casts = [
		'permiso_id' => 'int',
		'estudio_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'permiso_id',
		'estudio_id',
		'creadopor_id',
		'modificadopor_id',
		'creado_en',
		'modificado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class);
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}
}
