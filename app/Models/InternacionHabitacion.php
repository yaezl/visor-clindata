<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHabitacion
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $nota
 * @property Carbon|null $borrado_en
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property int|null $sala_id
 * @property int|null $estado_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * 
 * @property Usuario|null $usuario
 * @property InternacionSala|null $internacion_sala
 * @property InternacionEstado|null $internacion_estado
 * @property Collection|InternacionCama[] $internacion_camas
 * @property Collection|InternacionHabitacionEtiquetum[] $internacion_habitacion_etiqueta
 *
 * @package App\Models
 */
class InternacionHabitacion extends Model
{
	protected $table = 'internacion_habitacion';
	public $timestamps = false;

	protected $casts = [
		'borrado_en' => 'datetime',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'sala_id' => 'int',
		'estado_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'nombre',
		'nota',
		'borrado_en',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'sala_id',
		'estado_id',
		'creado_en',
		'modificado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_sala()
	{
		return $this->belongsTo(InternacionSala::class, 'sala_id');
	}

	public function internacion_estado()
	{
		return $this->belongsTo(InternacionEstado::class, 'estado_id');
	}

	public function internacion_camas()
	{
		return $this->hasMany(InternacionCama::class, 'habitacion_id');
	}

	public function internacion_habitacion_etiqueta()
	{
		return $this->hasMany(InternacionHabitacionEtiquetum::class, 'habitacion_id');
	}
}
