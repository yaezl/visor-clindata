<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionSala
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property int|null $estado_id
 * @property int|null $almacen_id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $institucion_id
 * @property string|null $codigo
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property InternacionEstado|null $internacion_estado
 * @property Almacen|null $almacen
 * @property Collection|FarDetalleHojaSolicitud[] $far_detalle_hoja_solicituds
 * @property Collection|InternacionHabitacion[] $internacion_habitacions
 * @property Collection|Almacen[] $almacens
 * @property Collection|InternacionSalaEtiquetum[] $internacion_sala_etiqueta
 *
 * @package App\Models
 */
class InternacionSala extends Model
{
	protected $table = 'internacion_sala';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'estado_id' => 'int',
		'almacen_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'estado_id',
		'almacen_id',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'institucion_id',
		'codigo'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_estado()
	{
		return $this->belongsTo(InternacionEstado::class, 'estado_id');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function far_detalle_hoja_solicituds()
	{
		return $this->hasMany(FarDetalleHojaSolicitud::class, 'sala_destino_id');
	}

	public function internacion_habitacions()
	{
		return $this->hasMany(InternacionHabitacion::class, 'sala_id');
	}

	public function almacens()
	{
		return $this->belongsToMany(Almacen::class, 'internacion_sala_almacenes_a_solicitar', 'sala_id')
					->withPivot('id', 'created_by', 'modified_by', 'prioridad', 'creado_en', 'modificado_en', 'borradoLogico');
	}

	public function internacion_sala_etiqueta()
	{
		return $this->hasMany(InternacionSalaEtiquetum::class, 'sala_id');
	}
}
