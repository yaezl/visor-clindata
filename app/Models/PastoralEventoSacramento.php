<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralEventoSacramento
 * 
 * @property int $evento_id
 * @property int $sacramento_id
 * 
 * @property PastoralEvento $pastoral_evento
 * @property PastoralSacramento $pastoral_sacramento
 *
 * @package App\Models
 */
class PastoralEventoSacramento extends Model
{
	protected $table = 'pastoral_evento_sacramento';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'evento_id' => 'int',
		'sacramento_id' => 'int'
	];

	public function pastoral_evento()
	{
		return $this->belongsTo(PastoralEvento::class, 'evento_id');
	}

	public function pastoral_sacramento()
	{
		return $this->belongsTo(PastoralSacramento::class, 'sacramento_id');
	}
}
