<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiagnosticoDetalle
 * 
 * @property int $id
 * @property int|null $diagnostico_id
 * @property int|null $detalle_id
 * @property int $orden
 * @property string $textodiagnostico
 * @property int|null $es_confirmado
 * @property int|null $tipo_diagnostico_principal_id
 * 
 * @property TipoDiagnosticoPrincipalHc|null $tipo_diagnostico_principal_hc
 * @property Diagnostico|null $diagnostico
 * @property Consultadetalle|null $consultadetalle
 *
 * @package App\Models
 */
class DiagnosticoDetalle extends Model
{
	protected $table = 'diagnostico_detalle';
	public $timestamps = false;

	protected $casts = [
		'diagnostico_id' => 'int',
		'detalle_id' => 'int',
		'orden' => 'int',
		'es_confirmado' => 'int',
		'tipo_diagnostico_principal_id' => 'int'
	];

	protected $fillable = [
		'diagnostico_id',
		'detalle_id',
		'orden',
		'textodiagnostico',
		'es_confirmado',
		'tipo_diagnostico_principal_id'
	];

	public function tipo_diagnostico_principal_hc()
	{
		return $this->belongsTo(TipoDiagnosticoPrincipalHc::class, 'tipo_diagnostico_principal_id');
	}

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'detalle_id');
	}
}
