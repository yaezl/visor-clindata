<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiasNoHabilesDow
 * 
 * @property int $id
 * @property int $dianohabil_id
 * @property int $dia
 * 
 * @property DiasNoHabile $dias_no_habile
 *
 * @package App\Models
 */
class DiasNoHabilesDow extends Model
{
	protected $table = 'dias_no_habiles_dow';
	public $timestamps = false;

	protected $casts = [
		'dianohabil_id' => 'int',
		'dia' => 'int'
	];

	protected $fillable = [
		'dianohabil_id',
		'dia'
	];

	public function dias_no_habile()
	{
		return $this->belongsTo(DiasNoHabile::class, 'dianohabil_id');
	}
}
