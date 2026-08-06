<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transferencium
 * 
 * @property int $id
 * @property string $nro_comprobante
 * @property string|null $cuenta_origen
 * @property string|null $titular_origen
 * 
 * @property Recibopago $recibopago
 *
 * @package App\Models
 */
class Transferencium extends Model
{
	protected $table = 'transferencia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nro_comprobante',
		'cuenta_origen',
		'titular_origen'
	];

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}
}
