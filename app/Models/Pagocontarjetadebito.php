<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagocontarjetadebito
 * 
 * @property int $id
 * @property int|null $tarjetadepago_id
 * @property string|null $nro_lote
 * 
 * @property Tarjetadepago|null $tarjetadepago
 * @property Recibopago $recibopago
 *
 * @package App\Models
 */
class Pagocontarjetadebito extends Model
{
	protected $table = 'pagocontarjetadebito';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'tarjetadepago_id' => 'int'
	];

	protected $fillable = [
		'tarjetadepago_id',
		'nro_lote'
	];

	public function tarjetadepago()
	{
		return $this->belongsTo(Tarjetadepago::class);
	}

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}
}
