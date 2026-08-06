<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RequiereAutorizacion
 * 
 * @property int $id
 * @property bool $requiere_autorizacion
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class RequiereAutorizacion extends Model
{
	protected $table = 'requiere_autorizacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'requiere_autorizacion' => 'bool'
	];

	protected $fillable = [
		'requiere_autorizacion'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
