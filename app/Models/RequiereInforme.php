<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RequiereInforme
 * 
 * @property int $id
 * @property bool $requiere_informe
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class RequiereInforme extends Model
{
	protected $table = 'requiere_informe';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'requiere_informe' => 'bool'
	];

	protected $fillable = [
		'requiere_informe'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
