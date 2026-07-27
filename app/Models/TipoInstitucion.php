<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoInstitucion
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $nombre
 * @property string|null $codigo
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * 
 * @property Usuario|null $usuario
 * @property Collection|Institucion[] $institucions
 *
 * @package App\Models
 */
class TipoInstitucion extends Model
{
	protected $table = 'tipo_institucion';
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
		'codigo',
		'borrado_logico',
		'modified_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function institucions()
	{
		return $this->hasMany(Institucion::class);
	}
}
