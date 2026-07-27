<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tributo
 * 
 * @property int $id
 * @property string $tipo
 * @property int $porcentaje
 * 
 * @property Collection|TributoObrasocial[] $tributo_obrasocials
 *
 * @package App\Models
 */
class Tributo extends Model
{
	protected $table = 'tributo';
	public $timestamps = false;

	protected $casts = [
		'porcentaje' => 'int'
	];

	protected $fillable = [
		'tipo',
		'porcentaje'
	];

	public function tributo_obrasocials()
	{
		return $this->hasMany(TributoObrasocial::class);
	}
}
