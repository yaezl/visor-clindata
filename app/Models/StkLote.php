<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkLote
 * 
 * @property int $id
 * @property int|null $movimientodetalle_id
 * @property int|null $item_id
 * @property int|null $articulotipopresentacion_id
 * @property string $codigo
 * @property string|null $codigo_trazabilidad
 * @property float|null $valorunitario
 * @property float|null $valorlote
 * @property Carbon|null $fechaingreso
 * @property Carbon|null $fechavencimiento
 * @property bool $esbueno
 * @property string|null $observaciones
 * 
 * @property Movimientodetalle|null $movimientodetalle
 * @property Item|null $item
 *
 * @package App\Models
 */
class StkLote extends Model
{
	protected $table = 'stk_lote';
	public $timestamps = false;

	protected $casts = [
		'movimientodetalle_id' => 'int',
		'item_id' => 'int',
		'articulotipopresentacion_id' => 'int',
		'valorunitario' => 'float',
		'valorlote' => 'float',
		'fechaingreso' => 'datetime',
		'fechavencimiento' => 'datetime',
		'esbueno' => 'bool'
	];

	protected $fillable = [
		'movimientodetalle_id',
		'item_id',
		'articulotipopresentacion_id',
		'codigo',
		'codigo_trazabilidad',
		'valorunitario',
		'valorlote',
		'fechaingreso',
		'fechavencimiento',
		'esbueno',
		'observaciones'
	];

	public function movimientodetalle()
	{
		return $this->belongsTo(Movimientodetalle::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
