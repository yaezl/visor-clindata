<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DermatologiaObjetivo
 * 
 * @property int $dermatologia_id
 * @property int $objetivo_id
 * 
 * @property Objetivo $objetivo
 * @property Dermatologium $dermatologium
 *
 * @package App\Models
 */
class DermatologiaObjetivo extends Model
{
	protected $table = 'dermatologia_objetivo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dermatologia_id' => 'int',
		'objetivo_id' => 'int'
	];

	public function objetivo()
	{
		return $this->belongsTo(Objetivo::class);
	}

	public function dermatologium()
	{
		return $this->belongsTo(Dermatologium::class, 'dermatologia_id');
	}
}
