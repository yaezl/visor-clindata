<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontopracticaestado
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * 
 * @property Collection|Odontoaplicacion[] $odontoaplicacions
 * @property Collection|Odontoimagen[] $odontoimagens
 *
 * @package App\Models
 */
class Odontopracticaestado extends Model
{
	protected $table = 'odontopracticaestado';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function odontoaplicacions()
	{
		return $this->hasMany(Odontoaplicacion::class, 'estado_id');
	}

	public function odontoimagens()
	{
		return $this->hasMany(Odontoimagen::class, 'aplica_a_estado_id');
	}
}
