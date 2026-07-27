<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lote
 * 
 * @property int $id
 * @property int|null $articulotipopresentacion_id
 * @property string $codigo
 * @property float|null $valorunitario
 * @property Carbon|null $fechavencimiento
 * @property int|null $item_id
 * @property int|null $movimientodetalle_id
 * @property float|null $valorlote
 * @property Carbon|null $fechaingreso
 * @property bool $esbueno
 * @property string|null $observaciones
 * @property int|null $procedencia_id
 * @property string|null $codigo_trazabilidad
 * @property string|null $nroExpediente
 * @property int|null $laboratorio_id
 * @property string|null $localizador
 * @property int|null $nroTransaccion
 * @property float|null $valorpromedio
 * 
 * @property Movimientodetalle|null $movimientodetalle
 * @property Item|null $item
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Procedencium|null $procedencium
 *
 * @package App\Models
 */
class Lote extends Model
{
	protected $table = 'lote';
	public $timestamps = false;

	protected $casts = [
		'articulotipopresentacion_id' => 'int',
		'valorunitario' => 'float',
		'fechavencimiento' => 'datetime',
		'item_id' => 'int',
		'movimientodetalle_id' => 'int',
		'valorlote' => 'float',
		'fechaingreso' => 'datetime',
		'esbueno' => 'bool',
		'procedencia_id' => 'int',
		'laboratorio_id' => 'int',
		'nroTransaccion' => 'int',
		'valorpromedio' => 'float'
	];

	protected $fillable = [
		'articulotipopresentacion_id',
		'codigo',
		'valorunitario',
		'fechavencimiento',
		'item_id',
		'movimientodetalle_id',
		'valorlote',
		'fechaingreso',
		'esbueno',
		'observaciones',
		'procedencia_id',
		'codigo_trazabilidad',
		'nroExpediente',
		'laboratorio_id',
		'localizador',
		'nroTransaccion',
		'valorpromedio'
	];

	public function movimientodetalle()
	{
		return $this->belongsTo(Movimientodetalle::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function procedencium()
	{
		return $this->belongsTo(Procedencium::class, 'procedencia_id');
	}
}
