<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Impuesto
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property int $created_by
 * @property int|null $modified_by
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Impuesto extends Model
{
	protected $table = 'impuestos';
	public $timestamps = false;

	protected $casts = [
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'codigo',
		'borrado_logico',
		'modified_at',
		'created_by',
		'modified_by'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}
}
