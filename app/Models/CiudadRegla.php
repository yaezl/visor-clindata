<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CiudadRegla
 * 
 * @property int $id
 * @property int|null $regla_agenda_id
 * @property int|null $ciudad_id
 * 
 * @property Ciudad|null $ciudad
 * @property ReglaAgendaCiudad|null $regla_agenda_ciudad
 *
 * @package App\Models
 */
class CiudadRegla extends Model
{
	protected $table = 'ciudad_regla';
	public $timestamps = false;

	protected $casts = [
		'regla_agenda_id' => 'int',
		'ciudad_id' => 'int'
	];

	protected $fillable = [
		'regla_agenda_id',
		'ciudad_id'
	];

	public function ciudad()
	{
		return $this->belongsTo(Ciudad::class);
	}

	public function regla_agenda_ciudad()
	{
		return $this->belongsTo(ReglaAgendaCiudad::class, 'regla_agenda_id');
	}
}
