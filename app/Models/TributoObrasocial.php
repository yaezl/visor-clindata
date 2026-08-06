<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TributoObrasocial
 * 
 * @property int $obrasocial_id
 * @property int $tributo_id
 * 
 * @property ObraSocial $obra_social
 * @property Tributo $tributo
 *
 * @package App\Models
 */
class TributoObrasocial extends Model
{
	protected $table = 'tributo_obrasocial';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'obrasocial_id' => 'int',
		'tributo_id' => 'int'
	];

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class, 'obrasocial_id');
	}

	public function tributo()
	{
		return $this->belongsTo(Tributo::class);
	}
}
