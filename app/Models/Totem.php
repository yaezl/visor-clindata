<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Totem
 * 
 * @property int $id
 * @property int|null $lugar_id
 * @property int|null $archivo_id
 * @property string $codigo
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * 
 * @property Lugar|null $lugar
 * @property Archivo|null $archivo
 *
 * @package App\Models
 */
class Totem extends Model
{
	use SoftDeletes;
	protected $table = 'totem';

	protected $casts = [
		'lugar_id' => 'int',
		'archivo_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'lugar_id',
		'archivo_id',
		'codigo',
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function lugar()
	{
		return $this->belongsTo(Lugar::class);
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}
}
