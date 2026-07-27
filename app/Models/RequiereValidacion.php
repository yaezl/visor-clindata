<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RequiereValidacion
 * 
 * @property int $id
 * @property bool $requiere_validacion
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class RequiereValidacion extends Model
{
	protected $table = 'requiere_validacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'requiere_validacion' => 'bool'
	];

	protected $fillable = [
		'requiere_validacion'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
