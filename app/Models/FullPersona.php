<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FullPersona
 * 
 * @property int $id
 * @property string $apellidos
 * @property string $nombres
 * @property int $documento
 *
 * @package App\Models
 */
class FullPersona extends Model
{
	protected $table = 'full_persona';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'documento' => 'int'
	];

	protected $fillable = [
		'apellidos',
		'nombres',
		'documento'
	];
}
