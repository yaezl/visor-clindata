<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InformedeestudioArchivo
 * 
 * @property int $informedeestudio_id
 * @property int $archivo_id
 * 
 * @property Informedeestudio $informedeestudio
 * @property Archivo $archivo
 *
 * @package App\Models
 */
class InformedeestudioArchivo extends Model
{
	protected $table = 'informedeestudio_archivo';
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
