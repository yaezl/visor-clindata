<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagocontarjetacredito
 * 
 * @property int $id
 * @property int|null $tarjetadepago_id
 * @property string|null $nro_lote
 * @property int $cantidad_cuotas
 * @property int|null $configuracion_cuotas_id
 * 
 * @property ConfiguracionCuota|null $configuracion_cuota
 * @property Tarjetadepago|null $tarjetadepago
 * @property Recibopago $recibopago
 *
 * @package App\Models
 */
class Pagocontarjetacredito extends Model
{
	protected $table = 'pagocontarjetacredito';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'tarjetadepago_id' => 'int',
		'cantidad_cuotas' => 'int',
		'configuracion_cuotas_id' => 'int'
	];

	protected $fillable = [
		'tarjetadepago_id',
		'nro_lote',
		'cantidad_cuotas',
		'configuracion_cuotas_id'
	];

	public function configuracion_cuota()
	{
		return $this->belongsTo(ConfiguracionCuota::class, 'configuracion_cuotas_id');
	}

	public function tarjetadepago()
	{
		return $this->belongsTo(Tarjetadepago::class);
	}

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}
}
