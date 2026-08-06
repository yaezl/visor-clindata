<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordendeoftalmologium
 * 
 * @property int $id
 * @property int|null $oftalmologia_id
 * 
 * @property Indicacion $indicacion
 * @property Oftalmologium|null $oftalmologium
 *
 * @package App\Models
 */
class Ordendeoftalmologium extends Model
{
	protected $table = 'ordendeoftalmologia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'oftalmologia_id' => 'int'
	];

	protected $fillable = [
		'oftalmologia_id'
	];

	public function indicacion()
	{
		return $this->belongsTo(Indicacion::class, 'id');
	}

	public function oftalmologium()
	{
		return $this->belongsTo(Oftalmologium::class, 'oftalmologia_id');
	}
}
