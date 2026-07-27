<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RestriccionesCobertura
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $sexo
 * @property int $copagoFijo
 * @property int $copagoVariable
 * @property int|null $frecuencia
 * @property int $duracion
 * @property string $observaciones
 * @property int $coberturaId
 * 
 * @property CoberturaSited $cobertura_sited
 *
 * @package App\Models
 */
class RestriccionesCobertura extends Model
{
	protected $table = 'RestriccionesCobertura';
	public $timestamps = false;

	protected $casts = [
		'copagoFijo' => 'int',
		'copagoVariable' => 'int',
		'frecuencia' => 'int',
		'duracion' => 'int',
		'coberturaId' => 'int'
	];

	protected $fillable = [
		'codigo',
		'nombre',
		'sexo',
		'copagoFijo',
		'copagoVariable',
		'frecuencia',
		'duracion',
		'observaciones',
		'coberturaId'
	];

	public function cobertura_sited()
	{
		return $this->belongsTo(CoberturaSited::class, 'coberturaId');
	}
}
