<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RequiereOrden
 * 
 * @property int $id
 * @property bool $requiere_orden
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class RequiereOrden extends Model
{
	protected $table = 'requiere_orden';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'requiere_orden' => 'bool'
	];

	protected $fillable = [
		'requiere_orden'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
