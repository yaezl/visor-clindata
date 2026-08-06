<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AntecPerinatalDiagnostico
 * 
 * @property int $antecedenteperinatal_id
 * @property int $diagnostico_id
 * 
 * @property Antecedenteperinatal $antecedenteperinatal
 * @property Diagnostico $diagnostico
 *
 * @package App\Models
 */
class AntecPerinatalDiagnostico extends Model
{
	protected $table = 'antec_perinatal_diagnostico';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'antecedenteperinatal_id' => 'int',
		'diagnostico_id' => 'int'
	];

	public function antecedenteperinatal()
	{
		return $this->belongsTo(Antecedenteperinatal::class);
	}

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}
}
