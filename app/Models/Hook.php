<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Hook
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $type_id
 * @property string $codigo
 * @property string $path
 * @property string|null $method
 * @property string|null $config
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Hook extends Model
{
	protected $table = 'hooks';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'type_id' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'type_id',
		'codigo',
		'path',
		'method',
		'config',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}
}
