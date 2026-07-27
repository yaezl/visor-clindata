<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaccione
 * 
 * @property int $id
 * @property int $id_turno
 * @property Carbon $creado_en
 * @property string|null $respuesta_niubiz
 * @property string|null $ecoreTransactionUUID
 * @property int|null $ecoreTransactionDate
 * @property string|null $eci
 * @property string|null $eci_description
 * @property string|null $paymentez_status
 * @property string|null $paymentez_payment_date
 * @property float|null $paymentez_amount
 * @property string|null $paymentez_message
 * @property int|null $paymentez_status_detail
 *
 * @package App\Models
 */
class Transaccione extends Model
{
	protected $table = 'transacciones';
	public $timestamps = false;

	protected $casts = [
		'id_turno' => 'int',
		'creado_en' => 'datetime',
		'ecoreTransactionDate' => 'int',
		'paymentez_amount' => 'float',
		'paymentez_status_detail' => 'int'
	];

	protected $fillable = [
		'id_turno',
		'creado_en',
		'respuesta_niubiz',
		'ecoreTransactionUUID',
		'ecoreTransactionDate',
		'eci',
		'eci_description',
		'paymentez_status',
		'paymentez_payment_date',
		'paymentez_amount',
		'paymentez_message',
		'paymentez_status_detail'
	];
}
