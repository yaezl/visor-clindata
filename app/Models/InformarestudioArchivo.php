<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InformarestudioArchivo
 * 
 * @property int $informedeestudio_id
 * @property int $archivo_id
 * 
 * @property Informedeestudio $informedeestudio
 * @property Archivo $archivo
 *
 * @package App\Models
 */
class InformarestudioArchivo extends Model
{
	protected $table = 'informarestudio_archivo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'informedeestudio_id' => 'int',
		'archivo_id' => 'int'
	];

	public function informedeestudio()
	{
		return $this->belongsTo(Informedeestudio::class);
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}
}
