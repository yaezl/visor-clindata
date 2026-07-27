<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipo
 * 
 * @property int $id
 * 
 * @property Especialidad|null $especialidad
 *
 * @package App\Models
 */
class Equipo extends Model
{
	protected $table = 'equipo';
	public $timestamps = false;

	public function especialidad()
	{
		return $this->hasOne(Especialidad::class);
	}
}
