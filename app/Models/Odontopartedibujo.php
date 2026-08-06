<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontopartedibujo
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * 
 * @property Collection|Odontoimagen[] $odontoimagens
 *
 * @package App\Models
 */
class Odontopartedibujo extends Model
{
	protected $table = 'odontopartedibujo';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function odontoimagens()
	{
		return $this->hasMany(Odontoimagen::class, 'aplica_a_id');
	}
}
