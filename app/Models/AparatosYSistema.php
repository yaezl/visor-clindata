<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AparatosYSistema
 * 
 * @property int $id
 * @property string|null $cardiovascular
 * @property string|null $respiratorio
 * @property string|null $gastrointestinal
 * @property string|null $genitourinario
 * @property string|null $neurologico
 * @property string|null $musculoEsqueletico
 * @property string|null $endocrino
 * @property string|null $dermatologico
 * 
 * @property Notabasica|null $notabasica
 *
 * @package App\Models
 */
class AparatosYSistema extends Model
{
	protected $table = 'aparatos_y_sistemas';
	public $timestamps = false;

	protected $fillable = [
		'cardiovascular',
		'respiratorio',
		'gastrointestinal',
		'genitourinario',
		'neurologico',
		'musculoEsqueletico',
		'endocrino',
		'dermatologico'
	];

	public function notabasica()
	{
		return $this->hasOne(Notabasica::class, 'aparatosYSistemas_id');
	}
}
