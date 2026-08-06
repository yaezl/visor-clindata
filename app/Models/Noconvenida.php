<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Noconvenida
 * 
 * @property int $id
 * @property bool $noconvenida
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class Noconvenida extends Model
{
	protected $table = 'noconvenida';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'noconvenida' => 'bool'
	];

	protected $fillable = [
		'noconvenida'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
