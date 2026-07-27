<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionProcedimiento
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $nombre
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $codigo
 * @property int $duracion
 * 
 * @property Usuario|null $usuario
 * @property Collection|InternacionOrden[] $internacion_ordens
 * @property Collection|InternacionOrdenProgramada[] $internacion_orden_programadas
 * @property Collection|ProcedimientoArticulotipopresentacion[] $procedimiento_articulotipopresentacions
 *
 * @package App\Models
 */
class InternacionProcedimiento extends Model
{
	protected $table = 'internacion_procedimiento';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'duracion' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'nombre',
		'descripcion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'codigo',
		'duracion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_ordens()
	{
		return $this->hasMany(InternacionOrden::class, 'procedimiento_id');
	}

	public function internacion_orden_programadas()
	{
		return $this->hasMany(InternacionOrdenProgramada::class, 'procedimiento_programado_id');
	}

	public function procedimiento_articulotipopresentacions()
	{
		return $this->hasMany(ProcedimientoArticulotipopresentacion::class, 'procedimiento_id');
	}
}
