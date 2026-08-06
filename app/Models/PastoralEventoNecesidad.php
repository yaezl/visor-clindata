<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralEventoNecesidad
 * 
 * @property int $evento_id
 * @property int $necesidad_id
 * 
 * @property PastoralEvento $pastoral_evento
 * @property PastoralNecesidad $pastoral_necesidad
 *
 * @package App\Models
 */
class PastoralEventoNecesidad extends Model
{
	protected $table = 'pastoral_evento_necesidad';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'evento_id' => 'int',
		'necesidad_id' => 'int'
	];

	public function pastoral_evento()
	{
		return $this->belongsTo(PastoralEvento::class, 'evento_id');
	}

	public function pastoral_necesidad()
	{
		return $this->belongsTo(PastoralNecesidad::class, 'necesidad_id');
	}
}
