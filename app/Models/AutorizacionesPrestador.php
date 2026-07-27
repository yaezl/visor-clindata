<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AutorizacionesPrestador
 * 
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borrado_logico
 *
 * @package App\Models
 */
class AutorizacionesPrestador extends Model
{
	use SoftDeletes;
	protected $table = 'autorizaciones_prestador';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'created_by',
		'modified_by',
		'deleted_by',
		'borrado_logico'
	];
}
