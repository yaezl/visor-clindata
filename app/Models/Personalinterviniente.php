<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Personalinterviniente
 * 
 * @property int $id
 * @property int|null $personal_id
 * @property int|null $detalle_id
 * 
 * @property Personal|null $personal
 * @property Consultadetalle|null $consultadetalle
 *
 * @package App\Models
 */
class Personalinterviniente extends Model
{
	protected $table = 'personalinterviniente';
	public $timestamps = false;

	protected $casts = [
		'personal_id' => 'int',
		'detalle_id' => 'int'
	];

	protected $fillable = [
		'personal_id',
		'detalle_id'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'detalle_id');
	}
}
