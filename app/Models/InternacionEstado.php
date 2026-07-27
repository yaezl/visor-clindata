<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionEstado
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $nombre
 * @property string $codigo
 * @property string $color
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 * @property Collection|InternacionCama[] $internacion_camas
 * @property Collection|InternacionHabitacion[] $internacion_habitacions
 * @property Collection|InternacionSala[] $internacion_salas
 *
 * @package App\Models
 */
class InternacionEstado extends Model
{
	protected $table = 'internacion_estado';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'nombre',
		'codigo',
		'color',
		'descripcion',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_camas()
	{
		return $this->hasMany(InternacionCama::class, 'estado_id');
	}

	public function internacion_habitacions()
	{
		return $this->hasMany(InternacionHabitacion::class, 'estado_id');
	}

	public function internacion_salas()
	{
		return $this->hasMany(InternacionSala::class, 'estado_id');
	}
}
