<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermisoturnoEspecialidad
 * 
 * @property int $id
 * @property int|null $permiso_id
 * @property int|null $especialidad_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon $borrado_en
 * 
 * @property Permiso|null $permiso
 * @property Especialidad|null $especialidad
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class PermisoturnoEspecialidad extends Model
{
	protected $table = 'permisoturno_especialidad';
	public $timestamps = false;

	protected $casts = [
		'permiso_id' => 'int',
		'especialidad_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'permiso_id',
		'especialidad_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function permiso()
	{
		return $this->belongsTo(Permiso::class);
	}

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
