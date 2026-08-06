<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Movimiento
 * 
 * @property int $id
 * @property int|null $cuenta_debito_id
 * @property int|null $cuenta_credito_id
 * @property int|null $documento_id
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $moneda_id
 * @property int|null $conversion_id
 * 
 * @property Conversion|null $conversion
 * @property Moneda|null $moneda
 * @property Cuentum|null $cuentum
 * @property Documento|null $documento
 * @property Collection|Movimientodetalle[] $movimientodetalles
 *
 * @package App\Models
 */
class Movimiento extends Model
{
	use SoftDeletes;
	protected $table = 'movimiento';

	protected $casts = [
		'cuenta_debito_id' => 'int',
		'cuenta_credito_id' => 'int',
		'documento_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'moneda_id' => 'int',
		'conversion_id' => 'int'
	];

	protected $fillable = [
		'cuenta_debito_id',
		'cuenta_credito_id',
		'documento_id',
		'created_by',
		'modified_by',
		'deleted_by',
		'moneda_id',
		'conversion_id'
	];

	public function conversion()
	{
		return $this->belongsTo(Conversion::class);
	}

	public function moneda()
	{
		return $this->belongsTo(Moneda::class);
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'cuenta_credito_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class);
	}

	public function movimientodetalles()
	{
		return $this->hasMany(Movimientodetalle::class);
	}
}
