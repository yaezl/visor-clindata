<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsultaRecetaElectronica
 * 
 * @property int $id
 * @property int|null $archivo_id
 * @property string $datos
 * 
 * @property Archivo|null $archivo
 * @property Indicacion $indicacion
 *
 * @package App\Models
 */
class ConsultaRecetaElectronica extends Model
{
	protected $table = 'consulta_recetaElectronica';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'archivo_id' => 'int'
	];

	protected $fillable = [
		'archivo_id',
		'datos'
	];

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}

	public function indicacion()
	{
		return $this->belongsTo(Indicacion::class, 'id');
	}
}
