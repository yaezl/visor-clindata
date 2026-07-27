<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Personacuentum
 * 
 * @property int $id
 * @property int|null $persona_id
 * 
 * @property Persona|null $persona
 * @property Cuentum $cuentum
 *
 * @package App\Models
 */
class Personacuentum extends Model
{
	protected $table = 'personacuenta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'persona_id' => 'int'
	];

	protected $fillable = [
		'persona_id'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'id');
	}
}
