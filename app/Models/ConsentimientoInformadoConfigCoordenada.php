<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsentimientoInformadoConfigCoordenada
 * 
 * @property int $id
 * @property bool $borradoLogico
 * @property string $nombreCampo
 * @property float $coordenadaX
 * @property float $coordenadaY
 * @property int $idConsentimientoConfig
 * @property int $paginaDestino
 * 
 * @property ConsentimientoInformadoConfig $consentimiento_informado_config
 *
 * @package App\Models
 */
class ConsentimientoInformadoConfigCoordenada extends Model
{
	protected $table = 'consentimientoInformadoConfigCoordenadas';
	public $timestamps = false;

	protected $casts = [
		'borradoLogico' => 'bool',
		'coordenadaX' => 'float',
		'coordenadaY' => 'float',
		'idConsentimientoConfig' => 'int',
		'paginaDestino' => 'int'
	];

	protected $fillable = [
		'borradoLogico',
		'nombreCampo',
		'coordenadaX',
		'coordenadaY',
		'idConsentimientoConfig',
		'paginaDestino'
	];

	public function consentimiento_informado_config()
	{
		return $this->belongsTo(ConsentimientoInformadoConfig::class, 'idConsentimientoConfig');
	}
}
