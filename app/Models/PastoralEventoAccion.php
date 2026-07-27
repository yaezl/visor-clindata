<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralEventoAccion
 * 
 * @property int $evento_id
 * @property int $accion_id
 * 
 * @property PastoralAccion $pastoral_accion
 * @property PastoralEvento $pastoral_evento
 *
 * @package App\Models
 */
class PastoralEventoAccion extends Model
{
	protected $table = 'pastoral_evento_accion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'evento_id' => 'int',
		'accion_id' => 'int'
	];

	public function pastoral_accion()
	{
		return $this->belongsTo(PastoralAccion::class, 'accion_id');
	}

	public function pastoral_evento()
	{
		return $this->belongsTo(PastoralEvento::class, 'evento_id');
	}
}
