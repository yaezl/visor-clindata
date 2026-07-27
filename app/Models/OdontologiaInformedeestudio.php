<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OdontologiaInformedeestudio
 * 
 * @property int $odontologia_id
 * @property int $informedeestudio_id
 * 
 * @property Odontologium $odontologium
 * @property Informedeestudio $informedeestudio
 *
 * @package App\Models
 */
class OdontologiaInformedeestudio extends Model
{
	protected $table = 'odontologia_informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'odontologia_id' => 'int',
		'informedeestudio_id' => 'int'
	];

	public function odontologium()
	{
		return $this->belongsTo(Odontologium::class, 'odontologia_id');
	}

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}
}
