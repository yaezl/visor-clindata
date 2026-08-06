<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BloqueoFuncione
 * 
 * @property int $id
 * @property int|null $modulo
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string|null $clase
 * @property string|null $metodo
 * @property string|null $codigo
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * @property bool $white_list
 * 
 * @property Collection|PerfilBloqueo[] $perfil_bloqueos
 *
 * @package App\Models
 */
class BloqueoFuncione extends Model
{
	protected $table = 'bloqueo_funciones';
	public $timestamps = false;

	protected $casts = [
		'modulo' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'white_list' => 'bool'
	];

	protected $fillable = [
		'modulo',
		'created_by',
		'modified_by',
		'clase',
		'metodo',
		'codigo',
		'modified_at',
		'borrado_logico',
		'white_list'
	];

	public function perfil_bloqueos()
	{
		return $this->hasMany(PerfilBloqueo::class, 'bloqueo_id');
	}
}
