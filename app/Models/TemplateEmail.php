<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TemplateEmail
 * 
 * @property int $id
 * @property string $nombre
 * @property string $mensaje
 * @property string $subjet
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
class TemplateEmail extends Model
{
	use SoftDeletes;
	protected $table = 'template_email';

	protected $casts = [
		'default' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'mensaje',
		'subjet',
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
