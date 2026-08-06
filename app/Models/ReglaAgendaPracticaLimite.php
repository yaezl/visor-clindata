<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaPracticaLimite
 * 
 * @property int $id
 * @property int|null $estudio_id
 * @property int $limite
 * 
 * @property Estudio|null $estudio
 * @property ReglaAgenda $regla_agenda
 *
 * @package App\Models
 */
class ReglaAgendaPracticaLimite extends Model
{
	protected $table = 'regla_agenda_practica_limite';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estudio_id' => 'int',
		'limite' => 'int'
	];

	protected $fillable = [
		'estudio_id',
		'limite'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}
}
