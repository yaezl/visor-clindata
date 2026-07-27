<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OftalmologiaInformedeestudio
 * 
 * @property int $oftalmologia_id
 * @property int $informedeestudio_id
 * 
 * @property Oftalmologium $oftalmologium
 * @property Informedeestudio $informedeestudio
 *
 * @package App\Models
 */
class OftalmologiaInformedeestudio extends Model
{
	protected $table = 'oftalmologia_informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'oftalmologia_id' => 'int',
		'informedeestudio_id' => 'int'
	];

	public function oftalmologium()
	{
		return $this->belongsTo(Oftalmologium::class, 'oftalmologia_id');
	}

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}
}
