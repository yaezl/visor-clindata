<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DermatologiaInformedeestudio
 * 
 * @property int $dermatologia_id
 * @property int $informedeestudio_id
 * 
 * @property Informedeestudio $informedeestudio
 * @property Dermatologium $dermatologium
 *
 * @package App\Models
 */
class DermatologiaInformedeestudio extends Model
{
	protected $table = 'dermatologia_informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dermatologia_id' => 'int',
		'informedeestudio_id' => 'int'
	];

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}

	public function dermatologium()
	{
		return $this->belongsTo(Dermatologium::class, 'dermatologia_id');
	}
}
