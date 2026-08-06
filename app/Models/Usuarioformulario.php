<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuarioformulario
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 *
 * @package App\Models
 */
class Usuarioformulario extends Model
{
	protected $table = 'usuarioformularios';
	public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password'
	];
}
