<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KinesiologiaTratamiento
 * 
 * @property int $kinesiologia_id
 * @property int $estudio_id
 * 
 * @property Estudio $estudio
 * @property Kinesiologium $kinesiologium
 *
 * @package App\Models
 */
class KinesiologiaTratamiento extends Model
{
	protected $table = 'kinesiologia_tratamientos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'kinesiologia_id' => 'int',
		'estudio_id' => 'int'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function kinesiologium()
	{
		return $this->belongsTo(Kinesiologium::class, 'kinesiologia_id');
	}
}
