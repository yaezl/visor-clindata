<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BonoMedicamentopartequirurgico
 * 
 * @property int $medicamentopartequirurgico_id
 * @property int $bono_id
 * 
 * @property Bono $bono
 * @property InternacionMedicamentoPa $internacion_medicamento_pa
 *
 * @package App\Models
 */
class BonoMedicamentopartequirurgico extends Model
{
	protected $table = 'bono_medicamentopartequirurgico';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'medicamentopartequirurgico_id' => 'int',
		'bono_id' => 'int'
	];

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}

	public function internacion_medicamento_pa()
	{
		return $this->belongsTo(InternacionMedicamentoPa::class, 'medicamentopartequirurgico_id');
	}
}
