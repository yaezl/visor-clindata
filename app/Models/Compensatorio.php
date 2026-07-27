<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compensatorio
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int|null $concepto_compensatorio_id
 * 
 * @property ConceptoCompensatorio|null $concepto_compensatorio
 * @property Recibopago $recibopago
 *
 * @package App\Models
 */
class Compensatorio extends Model
{
	protected $table = 'compensatorio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'concepto_compensatorio_id' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'concepto_compensatorio_id'
	];

	public function concepto_compensatorio()
	{
		return $this->belongsTo(ConceptoCompensatorio::class);
	}

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}
}
