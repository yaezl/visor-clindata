<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Anulacionrecibo
 * 
 * @property int $id
 * @property int|null $recibo_id
 * @property string|null $observacion
 * 
 * @property Recibo|null $recibo
 * @property Documento $documento
 *
 * @package App\Models
 */
class Anulacionrecibo extends Model
{
	protected $table = 'anulacionrecibo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'recibo_id' => 'int'
	];

	protected $fillable = [
		'recibo_id',
		'observacion'
	];

	public function recibo()
	{
		return $this->belongsTo(Recibo::class);
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}
}
