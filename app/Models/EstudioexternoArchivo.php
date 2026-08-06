<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstudioexternoArchivo
 * 
 * @property int $examenexterno_id
 * @property int $archivo_id
 * 
 * @property Estudioexterno $estudioexterno
 * @property Archivo $archivo
 *
 * @package App\Models
 */
class EstudioexternoArchivo extends Model
{
	protected $table = 'estudioexterno_archivo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'examenexterno_id' => 'int',
		'archivo_id' => 'int'
	];

	public function estudioexterno()
	{
		return $this->belongsTo(Estudioexterno::class, 'examenexterno_id');
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}
}
