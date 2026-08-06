<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermisoAlmacenDistribuye
 * 
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $permiso_id
 * @property int|null $almacen_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Permiso|null $permiso
 * @property Almacen|null $almacen
 *
 * @package App\Models
 */
class PermisoAlmacenDistribuye extends Model
{
	protected $table = 'permiso_almacen_distribuye';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'permiso_id' => 'int',
		'almacen_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'usuario_id',
		'permiso_id',
		'almacen_id',
		'creadopor_id',
		'modificadopor_id',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class);
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}
}
