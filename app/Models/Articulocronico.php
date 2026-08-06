<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Articulocronico
 * 
 * @property int $id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $persona_id
 * @property int|null $via_administracion_id
 * @property int|null $frecuencia_id
 * @property int|null $cantidad
 * @property int|null $frecuencia_cantidad
 * @property string|null $observacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property bool $borrado_logico
 * 
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Persona|null $persona
 * @property Viaadministracion|null $viaadministracion
 * @property Frecuencium|null $frecuencium
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Articulocronico extends Model
{
	protected $table = 'articulocronico';
	public $timestamps = false;

	protected $casts = [
		'articulotipopresentacion_id' => 'int',
		'persona_id' => 'int',
		'via_administracion_id' => 'int',
		'frecuencia_id' => 'int',
		'cantidad' => 'int',
		'frecuencia_cantidad' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'articulotipopresentacion_id',
		'persona_id',
		'via_administracion_id',
		'frecuencia_id',
		'cantidad',
		'frecuencia_cantidad',
		'observacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'borrado_logico'
	];

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function viaadministracion()
	{
		return $this->belongsTo(Viaadministracion::class, 'via_administracion_id');
	}

	public function frecuencium()
	{
		return $this->belongsTo(Frecuencium::class, 'frecuencia_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
