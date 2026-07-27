<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HookType
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class HookType extends Model
{
	protected $table = 'hook_type';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'codigo',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}
}
