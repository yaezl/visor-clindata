<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontoparteboca
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * 
 * @property Collection|Odontoaplicacion[] $odontoaplicacions
 *
 * @package App\Models
 */
class Odontoparteboca extends Model
{
	protected $table = 'odontoparteboca';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function odontoaplicacions()
	{
		return $this->hasMany(Odontoaplicacion::class, 'parteboca_id');
	}
}
