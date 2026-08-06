<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ObraSocialSssalud
 * 
 * @property int $id
 * @property string $codigo_rnos
 * @property string $denominacion
 * @property string $sigla
 * @property string $domicilio
 * @property string $localidad
 * @property string $provincia
 * @property string $telefono
 * @property string $email
 * @property string $web
 *
 * @package App\Models
 */
class ObraSocialSssalud extends Model
{
	protected $table = 'obra_social_sssalud';
	public $timestamps = false;

	protected $fillable = [
		'codigo_rnos',
		'denominacion',
		'sigla',
		'domicilio',
		'localidad',
		'provincia',
		'telefono',
		'email',
		'web'
	];
}
