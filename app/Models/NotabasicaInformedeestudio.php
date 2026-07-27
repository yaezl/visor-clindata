<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NotabasicaInformedeestudio
 * 
 * @property int $notabasica_id
 * @property int $informedeestudio_id
 * 
 * @property Notabasica $notabasica
 * @property Informedeestudio $informedeestudio
 *
 * @package App\Models
 */
class NotabasicaInformedeestudio extends Model
{
	protected $table = 'notabasica_informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'notabasica_id' => 'int',
		'informedeestudio_id' => 'int'
	];

	public function notabasica()
	{
		return $this->belongsTo(Notabasica::class);
	}

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}
}
