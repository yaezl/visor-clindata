<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recibopago
 * 
 * @property int $id
 * @property int|null $tipopago_id
 * @property int|null $recibo_id
 * @property float $monto
 * @property string $dtype
 * @property int|null $moneda_id
 * @property int|null $conversion_id
 * 
 * @property Conversion|null $conversion
 * @property Moneda|null $moneda
 * @property Tipopago|null $tipopago
 * @property Recibo|null $recibo
 * @property Cheque|null $cheque
 * @property Compensatorio|null $compensatorio
 * @property Efectivo|null $efectivo
 * @property MercadoPago|null $mercado_pago
 * @property Pagocontarjetacredito|null $pagocontarjetacredito
 * @property Pagocontarjetadebito|null $pagocontarjetadebito
 * @property Pagocontarjetaqr|null $pagocontarjetaqr
 * @property Transferencium|null $transferencium
 *
 * @package App\Models
 */
class Recibopago extends Model
{
	protected $table = 'recibopago';
	public $timestamps = false;

	protected $casts = [
		'tipopago_id' => 'int',
		'recibo_id' => 'int',
		'monto' => 'float',
		'moneda_id' => 'int',
		'conversion_id' => 'int'
	];

	protected $fillable = [
		'tipopago_id',
		'recibo_id',
		'monto',
		'dtype',
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

	public function tipopago()
	{
		return $this->belongsTo(Tipopago::class);
	}

	public function recibo()
	{
		return $this->belongsTo(Recibo::class);
	}

	public function cheque()
	{
		return $this->hasOne(Cheque::class, 'id');
	}

	public function compensatorio()
	{
		return $this->hasOne(Compensatorio::class, 'id');
	}

	public function efectivo()
	{
		return $this->hasOne(Efectivo::class, 'id');
	}

	public function mercado_pago()
	{
		return $this->hasOne(MercadoPago::class, 'id');
	}

	public function pagocontarjetacredito()
	{
		return $this->hasOne(Pagocontarjetacredito::class, 'id');
	}

	public function pagocontarjetadebito()
	{
		return $this->hasOne(Pagocontarjetadebito::class, 'id');
	}

	public function pagocontarjetaqr()
	{
		return $this->hasOne(Pagocontarjetaqr::class, 'id');
	}

	public function transferencium()
	{
		return $this->hasOne(Transferencium::class, 'id');
	}
}
