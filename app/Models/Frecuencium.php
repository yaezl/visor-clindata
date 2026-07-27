<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Frecuencium
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|Articulocronico[] $articulocronicos
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 *
 * @package App\Models
 */
class Frecuencium extends Model
{
	protected $table = 'frecuencia';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function articulocronicos()
	{
		return $this->hasMany(Articulocronico::class, 'frecuencia_id');
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'frecuencia_id');
	}
}
