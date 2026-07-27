<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionTipoAltum
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * 
 * @property Usuario $usuario
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 *
 * @package App\Models
 */
class InternacionTipoAltum extends Model
{
	protected $table = 'internacion_tipo_alta';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'borrado_logico',
		'modified_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'tipo_alta_id');
	}
}
