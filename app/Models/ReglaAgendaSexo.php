<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaSexo
 * 
 * @property int $id
 * @property string|null $sexo
 * 
 * @property ReglaAgenda $regla_agenda
 *
 * @package App\Models
 */
class ReglaAgendaSexo extends Model
{
	protected $table = 'regla_agenda_sexo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'sexo'
	];

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}
}
