<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDiagnosticoPrincipalHc
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|DiagnosticoDetalle[] $diagnostico_detalles
 *
 * @package App\Models
 */
class TipoDiagnosticoPrincipalHc extends Model
{
	protected $table = 'tipo_diagnostico_principal_hc';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function diagnostico_detalles()
	{
		return $this->hasMany(DiagnosticoDetalle::class, 'tipo_diagnostico_principal_id');
	}
}
