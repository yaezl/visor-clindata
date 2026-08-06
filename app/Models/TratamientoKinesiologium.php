<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TratamientoKinesiologium
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $cantidad_sesiones
 * @property bool $activo
 * @property int|null $sesiones_tomadas
 * 
 * @property Persona|null $persona
 * @property Collection|Kinesiologium[] $kinesiologia
 *
 * @package App\Models
 */
class TratamientoKinesiologium extends Model
{
	protected $table = 'tratamiento_kinesiologia';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'cantidad_sesiones' => 'int',
		'activo' => 'bool',
		'sesiones_tomadas' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'cantidad_sesiones',
		'activo',
		'sesiones_tomadas'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function kinesiologia()
	{
		return $this->hasMany(Kinesiologium::class, 'tratamiento_id');
	}
}
