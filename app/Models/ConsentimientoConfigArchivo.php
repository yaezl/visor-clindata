<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsentimientoConfigArchivo
 * 
 * @property int $id
 * @property int $idConsentimientoConfig
 * @property int $idArchivo
 * 
 * @property Archivo $archivo
 * @property ConsentimientoInformadoConfig $consentimiento_informado_config
 *
 * @package App\Models
 */
class ConsentimientoConfigArchivo extends Model
{
	protected $table = 'consentimientoConfigArchivo';
	public $timestamps = false;

	protected $casts = [
		'idConsentimientoConfig' => 'int',
		'idArchivo' => 'int'
	];

	protected $fillable = [
		'idConsentimientoConfig',
		'idArchivo'
	];

	public function archivo()
	{
		return $this->belongsTo(Archivo::class, 'idArchivo');
	}

	public function consentimiento_informado_config()
	{
		return $this->belongsTo(ConsentimientoInformadoConfig::class, 'idConsentimientoConfig');
	}
}
