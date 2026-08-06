<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExploracionFisica
 * 
 * @property int $id
 * @property string|null $habitusExterior
 * @property string|null $cabeza
 * @property string|null $cuello
 * @property string|null $torax
 * @property string|null $abdomen
 * @property string|null $brazos
 * @property string|null $piernas
 * @property string|null $genitales
 * 
 * @property Notabasica|null $notabasica
 *
 * @package App\Models
 */
class ExploracionFisica extends Model
{
	protected $table = 'exploracion_fisica';
	public $timestamps = false;

	protected $fillable = [
		'habitusExterior',
		'cabeza',
		'cuello',
		'torax',
		'abdomen',
		'brazos',
		'piernas',
		'genitales'
	];

	public function notabasica()
	{
		return $this->hasOne(Notabasica::class, 'exploracionFisica_id');
	}
}
