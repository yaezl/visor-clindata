<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagocontarjetaqr
 * 
 * @property int $id
 * @property int|null $tarjetaDePago_id
 * @property string|null $nroLote
 * 
 * @property Recibopago $recibopago
 * @property Tarjetadepago|null $tarjetadepago
 *
 * @package App\Models
 */
class Pagocontarjetaqr extends Model
{
	protected $table = 'pagocontarjetaqr';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'tarjetaDePago_id' => 'int'
	];

	protected $fillable = [
		'tarjetaDePago_id',
		'nroLote'
	];

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}

	public function tarjetadepago()
	{
		return $this->belongsTo(Tarjetadepago::class, 'tarjetaDePago_id');
	}
}
