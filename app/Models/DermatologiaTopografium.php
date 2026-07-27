<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DermatologiaTopografium
 * 
 * @property int $dermatologia_id
 * @property int $topografia_id
 * 
 * @property Topografium $topografium
 * @property Dermatologium $dermatologium
 *
 * @package App\Models
 */
class DermatologiaTopografium extends Model
{
	protected $table = 'dermatologia_topografia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dermatologia_id' => 'int',
		'topografia_id' => 'int'
	];

	public function topografium()
	{
		return $this->belongsTo(Topografium::class, 'topografia_id');
	}

	public function dermatologium()
	{
		return $this->belongsTo(Dermatologium::class, 'dermatologia_id');
	}
}
