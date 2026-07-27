<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionEtiquetum
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $nombre
 * @property string $codigo
 * @property string $color
 * @property string $descripcion
 * @property bool $fija
 * @property bool $bloqueante
 * @property int|null $edad
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $sexo
 * 
 * @property Usuario|null $usuario
 * @property Collection|DeclaracionEtiqueta[] $declaracion_etiquetas
 * @property Collection|InternacionCamaEtiquetum[] $internacion_cama_etiqueta
 * @property Collection|InternacionHabitacionEtiquetum[] $internacion_habitacion_etiqueta
 * @property Collection|InternacionSalaEtiquetum[] $internacion_sala_etiqueta
 * @property Collection|OrdeninternacionEtiquetum[] $ordeninternacion_etiqueta
 *
 * @package App\Models
 */
class InternacionEtiquetum extends Model
{
	protected $table = 'internacion_etiqueta';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'fija' => 'bool',
		'bloqueante' => 'bool',
		'edad' => 'int',
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
		'fija',
		'bloqueante',
		'edad',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'sexo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function declaracion_etiquetas()
	{
		return $this->hasMany(DeclaracionEtiqueta::class, 'etiqueta_id');
	}

	public function internacion_cama_etiqueta()
	{
		return $this->hasMany(InternacionCamaEtiquetum::class, 'etiqueta_id');
	}

	public function internacion_habitacion_etiqueta()
	{
		return $this->hasMany(InternacionHabitacionEtiquetum::class, 'etiqueta_id');
	}

	public function internacion_sala_etiqueta()
	{
		return $this->hasMany(InternacionSalaEtiquetum::class, 'etiqueta_id');
	}

	public function ordeninternacion_etiqueta()
	{
		return $this->hasMany(OrdeninternacionEtiquetum::class, 'etiqueta_id');
	}
}
