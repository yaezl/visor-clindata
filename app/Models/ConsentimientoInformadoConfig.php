<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsentimientoInformadoConfig
 * 
 * @property int $id
 * @property bool $borradoLogico
 * @property string $nombreReporte
 * @property string $controladorPath
 * @property string $etiquetaBoton
 * @property Carbon $createdAt
 * @property string|null $descripcion
 * @property Carbon $modifiedAt
 * @property int $createdBy
 * @property int $modifiedBy_id
 * @property string|null $size
 * 
 * @property Usuario $usuario
 * @property Collection|ConsentimientoConfigArchivo[] $consentimiento_config_archivos
 * @property Collection|ConsentimientoInformadoConfigCoordenada[] $consentimiento_informado_config_coordenadas
 *
 * @package App\Models
 */
class ConsentimientoInformadoConfig extends Model
{
	protected $table = 'consentimientoInformadoConfig';
	public $timestamps = false;

	protected $casts = [
		'borradoLogico' => 'bool',
		'createdAt' => 'datetime',
		'modifiedAt' => 'datetime',
		'createdBy' => 'int',
		'modifiedBy_id' => 'int'
	];

	protected $fillable = [
		'borradoLogico',
		'nombreReporte',
		'controladorPath',
		'etiquetaBoton',
		'createdAt',
		'descripcion',
		'modifiedAt',
		'createdBy',
		'modifiedBy_id',
		'size'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modifiedBy_id');
	}

	public function consentimiento_config_archivos()
	{
		return $this->hasMany(ConsentimientoConfigArchivo::class, 'idConsentimientoConfig');
	}

	public function consentimiento_informado_config_coordenadas()
	{
		return $this->hasMany(ConsentimientoInformadoConfigCoordenada::class, 'idConsentimientoConfig');
	}
}
