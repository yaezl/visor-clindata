<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaConsumoDescartable
 * 
 * @property int $id
 * @property int|null $persona_internacion_id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $almacen_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property float $cantidad
 * @property Carbon $createdAt
 * @property Carbon $modifiedAt
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property InternacionPersona|null $internacion_persona
 * @property Almacen|null $almacen
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaConsumoDescartable extends Model
{
	protected $table = 'internacion_hoja_enfermeria_consumo_descartables';
	public $timestamps = false;

	protected $casts = [
		'persona_internacion_id' => 'int',
		'articulotipopresentacion_id' => 'int',
		'almacen_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'cantidad' => 'float',
		'createdAt' => 'datetime',
		'modifiedAt' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'persona_internacion_id',
		'articulotipopresentacion_id',
		'almacen_id',
		'created_by',
		'modified_by',
		'cantidad',
		'createdAt',
		'modifiedAt',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}
}
