<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sited
 * 
 * @property int $id
 * @property string|null $numeroAutorizacion
 * @property string $numeroAsegurado
 * @property string $nombreProducto
 * @property Carbon $inicioVigencia
 * @property Carbon $finVigencia
 * @property string $numeroSoliOrigen
 * @property int $tipoAfiliacion
 * @property string $codigoTipoAfiliacion
 * @property int $parentesco
 * @property string $nombreParentesco
 * @property string $numeroContratoPoliza
 * @property int $moneda
 * @property string $nombreMoneda
 * @property int $estadoCivil
 * @property string $codigoEstadoCivil
 * @property string|null $numeroAccidente
 * @property Carbon $createdAt
 * @property string $fechaHoraAutorizacion
 * @property int|null $coberturaId
 * @property int|null $titularId
 * @property int|null $datosAdicionalesId
 * @property int|null $observacionId
 * @property string|null $nombresAsegurado
 * @property string|null $apellidosAsegurado
 * @property string|null $sexo
 * @property string|null $tipoDocumento
 * @property string|null $numeroDocumento
 * @property Carbon|null $fechaNacimiento
 * @property int $creadopor_id
 * @property string|null $codigoProducto
 * @property string|null $codigoIafa
 * 
 * @property DatosAdicionalesSited|null $datos_adicionales_sited
 * @property TitularSited|null $titular_sited
 * @property CoberturaSited|null $cobertura_sited
 * @property ObservacionesSited|null $observaciones_sited
 * @property Usuario $usuario
 * @property Collection|CondicionesMedicasSited[] $condiciones_medicas_siteds
 * @property Collection|ExtensionVigenciaSited[] $extension_vigencia_siteds
 *
 * @package App\Models
 */
class Sited extends Model
{
	protected $table = 'siteds';
	public $timestamps = false;

	protected $casts = [
		'inicioVigencia' => 'datetime',
		'finVigencia' => 'datetime',
		'tipoAfiliacion' => 'int',
		'parentesco' => 'int',
		'moneda' => 'int',
		'estadoCivil' => 'int',
		'createdAt' => 'datetime',
		'coberturaId' => 'int',
		'titularId' => 'int',
		'datosAdicionalesId' => 'int',
		'observacionId' => 'int',
		'fechaNacimiento' => 'datetime',
		'creadopor_id' => 'int'
	];

	protected $fillable = [
		'numeroAutorizacion',
		'numeroAsegurado',
		'nombreProducto',
		'inicioVigencia',
		'finVigencia',
		'numeroSoliOrigen',
		'tipoAfiliacion',
		'codigoTipoAfiliacion',
		'parentesco',
		'nombreParentesco',
		'numeroContratoPoliza',
		'moneda',
		'nombreMoneda',
		'estadoCivil',
		'codigoEstadoCivil',
		'numeroAccidente',
		'createdAt',
		'fechaHoraAutorizacion',
		'coberturaId',
		'titularId',
		'datosAdicionalesId',
		'observacionId',
		'nombresAsegurado',
		'apellidosAsegurado',
		'sexo',
		'tipoDocumento',
		'numeroDocumento',
		'fechaNacimiento',
		'creadopor_id',
		'codigoProducto',
		'codigoIafa'
	];

	public function datos_adicionales_sited()
	{
		return $this->belongsTo(DatosAdicionalesSited::class, 'datosAdicionalesId');
	}

	public function titular_sited()
	{
		return $this->belongsTo(TitularSited::class, 'titularId');
	}

	public function cobertura_sited()
	{
		return $this->belongsTo(CoberturaSited::class, 'coberturaId');
	}

	public function observaciones_sited()
	{
		return $this->belongsTo(ObservacionesSited::class, 'observacionId');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function condiciones_medicas_siteds()
	{
		return $this->hasMany(CondicionesMedicasSited::class, 'sitedsId');
	}

	public function extension_vigencia_siteds()
	{
		return $this->hasMany(ExtensionVigenciaSited::class, 'sitedsId');
	}
}
