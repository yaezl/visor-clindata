<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Copago
 * 
 * @property int $id
 * @property float $monto
 * @property int|null $tipocopago_id
 * 
 * @property Tipocopago|null $tipocopago
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class Copago extends Model
{
	protected $table = 'copago';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'monto' => 'float',
		'tipocopago_id' => 'int'
	];

	protected $fillable = [
		'monto',
		'tipocopago_id'
	];

	public function tipocopago()
	{
		return $this->belongsTo(Tipocopago::class);
	}

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
