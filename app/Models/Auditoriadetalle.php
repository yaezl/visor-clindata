<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Auditoriadetalle
 * 
 * @property int $id
 * @property int $detalle_id
 * @property string|null $json_hash
 * @property string|null $receipt_id
 * @property int|null $timestamp
 * @property string|null $receipt
 * @property string $proof_version
 * @property string|null $btc_merkle_root
 * @property string|null $btc_block
 * 
 * @property Consultadetalle $consultadetalle
 *
 * @package App\Models
 */
class Auditoriadetalle extends Model
{
	protected $table = 'auditoriadetalle';
	public $timestamps = false;

	protected $casts = [
		'detalle_id' => 'int',
		'timestamp' => 'int'
	];

	protected $fillable = [
		'detalle_id',
		'json_hash',
		'receipt_id',
		'timestamp',
		'receipt',
		'proof_version',
		'btc_merkle_root',
		'btc_block'
	];

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'detalle_id');
	}
}
