<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SaludmentalInformedeestudio
 * 
 * @property int $saludmental_id
 * @property int $informedeestudio_id
 * 
 * @property Saludmental $saludmental
 * @property Informedeestudio $informedeestudio
 *
 * @package App\Models
 */
class SaludmentalInformedeestudio extends Model
{
	protected $table = 'saludmental_informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'saludmental_id' => 'int',
		'informedeestudio_id' => 'int'
	];

	public function saludmental()
	{
		return $this->belongsTo(Saludmental::class);
	}

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}
}
