<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BonoPartequirurgico
 * 
 * @property int $estudiopartequirurgico_id
 * @property int $bono_id
 * 
 * @property InternacionEstudioPq $internacion_estudio_pq
 * @property Bono $bono
 *
 * @package App\Models
 */
class BonoPartequirurgico extends Model
{
	protected $table = 'bono_partequirurgico';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'estudiopartequirurgico_id' => 'int',
		'bono_id' => 'int'
	];

	public function internacion_estudio_pq()
	{
		return $this->belongsTo(InternacionEstudioPq::class, 'estudiopartequirurgico_id');
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}
}
