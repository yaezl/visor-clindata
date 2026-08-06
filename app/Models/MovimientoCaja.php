<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MovimientoCaja
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $concepto_id
 * @property int|null $tipo_id
 * @property string|null $observaciones
 * @property Carbon $fecha
 * @property float $importe
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property bool $borrado_logico
 * @property int|null $personal_id
 * @property int|null $persona_id
 * @property int|null $tarjeta_id
 * @property int|null $caja_id
 * @property bool $mercadoPago
 * 
 * @property Usuario|null $usuario
 * @property Caja|null $caja
 * @property Personal|null $personal
 * @property MovimientoConcepto|null $movimiento_concepto
 * @property TipoMovimiento|null $tipo_movimiento
 * @property Tarjetadepago|null $tarjetadepago
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class MovimientoCaja extends Model
{
	protected $table = 'movimiento_caja';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'concepto_id' => 'int',
		'tipo_id' => 'int',
		'fecha' => 'datetime',
		'importe' => 'float',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'personal_id' => 'int',
		'persona_id' => 'int',
		'tarjeta_id' => 'int',
		'caja_id' => 'int',
		'mercadoPago' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'concepto_id',
		'tipo_id',
		'observaciones',
		'fecha',
		'importe',
		'modified_at',
		'borrado_logico',
		'personal_id',
		'persona_id',
		'tarjeta_id',
		'caja_id',
		'mercadoPago'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function caja()
	{
		return $this->belongsTo(Caja::class);
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function movimiento_concepto()
	{
		return $this->belongsTo(MovimientoConcepto::class, 'concepto_id');
	}

	public function tipo_movimiento()
	{
		return $this->belongsTo(TipoMovimiento::class, 'tipo_id');
	}

	public function tarjetadepago()
	{
		return $this->belongsTo(Tarjetadepago::class, 'tarjeta_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
