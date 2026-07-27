<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PediatriaParametro
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * 
 * @property Collection|PediatriaPercentil[] $pediatria_percentils
 *
 * @package App\Models
 */
class PediatriaParametro extends Model
{
	protected $table = 'pediatria_parametro';
	public $timestamps = false;

	protected $fillable = [
		'codigo',
		'nombre'
	];

	public function pediatria_percentils()
	{
		return $this->hasMany(PediatriaPercentil::class);
	}
}
