<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Genero
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Genero extends Model
{
	protected $table = 'genero';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function personas()
	{
		return $this->hasMany(Persona::class);
	}
}
