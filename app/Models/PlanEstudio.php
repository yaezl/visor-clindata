<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanEstudio
 * 
 * @property int $plan_id
 * @property int $estudio_id
 * 
 * @property Estudio $estudio
 * @property Plan $plan
 *
 * @package App\Models
 */
class PlanEstudio extends Model
{
	protected $table = 'plan_estudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'plan_id' => 'int',
		'estudio_id' => 'int'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
