<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Multiplicador
 * 
 * @property int $id
 * @property float $porciento
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class Multiplicador extends Model
{
	protected $table = 'multiplicador';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'porciento' => 'float'
	];

	protected $fillable = [
		'porciento'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
