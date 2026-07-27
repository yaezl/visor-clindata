<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TemplateSm
 * 
 * @property int $id
 * @property string $nombre
 * @property string $mensaje
 * @property bool $default
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon|null $updated_at
 * @property int|null $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class TemplateSm extends Model
{
	use SoftDeletes;
	protected $table = 'template_sms';

	protected $casts = [
		'default' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'mensaje',
		'default',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}
}
