<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Motivodenotum
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property string|null $codigo_ad_hoc
 * 
 * @property Collection|Notacredito[] $notacreditos
 * @property Collection|Notadebito[] $notadebitos
 *
 * @package App\Models
 */
class Motivodenotum extends Model
{
	protected $table = 'motivodenota';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo',
		'codigo_ad_hoc'
	];

	public function notacreditos()
	{
		return $this->hasMany(Notacredito::class, 'motivodenota_id');
	}

	public function notadebitos()
	{
		return $this->hasMany(Notadebito::class, 'motivodenota_id');
	}
}
