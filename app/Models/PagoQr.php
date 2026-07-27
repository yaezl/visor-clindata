<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PagoQr
 * 
 * @property int $id
 * @property int|null $bono_id
 * @property string $id_pago
 * @property string $estado
 * @property float $monto
 * @property string $moneda
 * @property string $pos_id
 * @property string|null $transaction_id
 * @property Carbon $created_at
 * @property Carbon|null $confirmed_at
 * 
 * @property Bono|null $bono
 *
 * @package App\Models
 */
class PagoQr extends Model
{
	protected $table = 'pago_qr';
	public $timestamps = false;

	protected $casts = [
		'bono_id' => 'int',
		'monto' => 'float',
		'confirmed_at' => 'datetime'
	];

	protected $fillable = [
		'bono_id',
		'id_pago',
		'estado',
		'monto',
		'moneda',
		'pos_id',
		'transaction_id',
		'confirmed_at'
	];

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}
}
