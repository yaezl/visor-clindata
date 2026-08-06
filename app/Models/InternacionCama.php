<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionCama
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $nota
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property int|null $habitacion_id
 * @property int|null $estado_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $cama_codigo_ad_hoc
 * 
 * @property Usuario|null $usuario
 * @property InternacionHabitacion|null $internacion_habitacion
 * @property InternacionEstado|null $internacion_estado
 * @property Collection|InternacionCamaEtiquetum[] $internacion_cama_etiqueta
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 *
 * @package App\Models
 */
class InternacionCama extends Model
{
	protected $table = 'internacion_cama';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'habitacion_id' => 'int',
		'estado_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'nombre',
		'nota',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'habitacion_id',
		'estado_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'cama_codigo_ad_hoc'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_habitacion()
	{
		return $this->belongsTo(InternacionHabitacion::class, 'habitacion_id');
	}

	public function internacion_estado()
	{
		return $this->belongsTo(InternacionEstado::class, 'estado_id');
	}

	public function internacion_cama_etiqueta()
	{
		return $this->hasMany(InternacionCamaEtiquetum::class, 'cama_id');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'cama_id');
	}
}
