<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutomaticHook
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $url
 * @property string $request_method
 * @property string $point
 * @property string|null $configOverride
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class AutomaticHook extends Model
{
	protected $table = 'automatic_hooks';
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
		'url',
		'request_method',
		'point',
		'configOverride',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}
}
