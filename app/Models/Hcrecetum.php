<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Hcrecetum
 * 
 * @property int $id
 * 
 * @property Indicacion $indicacion
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 *
 * @package App\Models
 */
class Hcrecetum extends Model
{
	protected $table = 'hcreceta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	public function indicacion()
	{
		return $this->belongsTo(Indicacion::class, 'id');
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'receta_id');
	}
}
