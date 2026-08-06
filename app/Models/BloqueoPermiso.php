<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BloqueoPermiso
 * 
 * @property int $id
 * @property int|null $bloqueo_funciones_id
 * @property int|null $permiso_id
 * @property bool $lectura
 * @property bool $escritura
 *
 * @package App\Models
 */
class BloqueoPermiso extends Model
{
	protected $table = 'bloqueo_permiso';
	public $timestamps = false;

	protected $casts = [
		'bloqueo_funciones_id' => 'int',
		'permiso_id' => 'int',
		'lectura' => 'bool',
		'escritura' => 'bool'
	];

	protected $fillable = [
		'bloqueo_funciones_id',
		'permiso_id',
		'lectura',
		'escritura'
	];
}
