<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cheque
 * 
 * @property int $id
 * @property int|null $banco_id
 * @property string $numero_cheque
 * @property Carbon|null $fecha
 * 
 * @property Banco|null $banco
 * @property Recibopago $recibopago
 *
 * @package App\Models
 */
class Cheque extends Model
{
	protected $table = 'cheque';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'banco_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'banco_id',
		'numero_cheque',
		'fecha'
	];

	public function banco()
	{
		return $this->belongsTo(Banco::class);
	}

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}
}
