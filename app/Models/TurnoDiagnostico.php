<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TurnoDiagnostico
 * 
 * @property int $turno_id
 * @property int $diagnostico_id
 * 
 * @property TurnoProgramado $turno_programado
 * @property Diagnostico $diagnostico
 *
 * @package App\Models
 */
class TurnoDiagnostico extends Model
{
	protected $table = 'turno_diagnostico';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'diagnostico_id' => 'int'
	];

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}
}
