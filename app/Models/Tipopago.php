<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipopago
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|Recibopago[] $recibopagos
 *
 * @package App\Models
 */
class Tipopago extends Model
{
	protected $table = 'tipopago';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function recibopagos()
	{
		return $this->hasMany(Recibopago::class);
	}
}
