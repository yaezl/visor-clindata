<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Turnero
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string $vista
 * @property int|null $color
 * @property int|null $institucion_id
 * 
 * @property Institucion|null $institucion
 * @property Collection|Lugar[] $lugars
 * @property Collection|TurneroMessage[] $turnero_messages
 * @property Collection|Asignacion[] $asignacions
 *
 * @package App\Models
 */
class Turnero extends Model
{
	protected $table = 'turnero';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'color' => 'int',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'codigo',
		'nombre',
		'created_by',
		'modified_by',
		'vista',
		'color',
		'institucion_id'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function lugars()
	{
		return $this->hasMany(Lugar::class);
	}

	public function turnero_messages()
	{
		return $this->hasMany(TurneroMessage::class);
	}

	public function asignacions()
	{
		return $this->belongsToMany(Asignacion::class, 'turneroasignacion')
					->withPivot('id', 'especialidad_id', 'agenda_id');
	}
}
