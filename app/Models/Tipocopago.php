<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipocopago
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|Copago[] $copagos
 *
 * @package App\Models
 */
class Tipocopago extends Model
{
	protected $table = 'tipocopago';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function copagos()
	{
		return $this->hasMany(Copago::class);
	}
}
