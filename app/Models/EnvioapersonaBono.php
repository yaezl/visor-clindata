<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EnvioapersonaBono
 * 
 * @property int $envio_id
 * @property int $bono_id
 * 
 * @property Envioapersona $envioapersona
 * @property Bono $bono
 *
 * @package App\Models
 */
class EnvioapersonaBono extends Model
{
	protected $table = 'envioapersona_bono';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'envio_id' => 'int',
		'bono_id' => 'int'
	];

	public function envioapersona()
	{
		return $this->belongsTo(Envioapersona::class, 'envio_id');
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}
}
