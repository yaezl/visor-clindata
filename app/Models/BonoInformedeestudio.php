<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BonoInformedeestudio
 * 
 * @property int $informedeestudio_id
 * @property int $bono_id
 * 
 * @property Bono $bono
 * @property Informedeestudio $informedeestudio
 *
 * @package App\Models
 */
class BonoInformedeestudio extends Model
{
	protected $table = 'bono_informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'informedeestudio_id' => 'int',
		'bono_id' => 'int'
	];

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}
}
