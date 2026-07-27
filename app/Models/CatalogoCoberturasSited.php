<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CatalogoCoberturasSited
 * 
 * @property int $id
 * @property int|null $tipoCobertura
 * @property string|null $subTipoCobertura
 * @property string $nombreCobertura
 * @property bool $activo
 * @property string $codigoCobertura
 * 
 * @property Collection|ModalidadCoberturaSited[] $modalidad_cobertura_siteds
 *
 * @package App\Models
 */
class CatalogoCoberturasSited extends Model
{
	protected $table = 'CatalogoCoberturasSiteds';
	public $timestamps = false;

	protected $casts = [
		'tipoCobertura' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'tipoCobertura',
		'subTipoCobertura',
		'nombreCobertura',
		'activo',
		'codigoCobertura'
	];

	public function modalidad_cobertura_siteds()
	{
		return $this->hasMany(ModalidadCoberturaSited::class, 'cobertura');
	}
}
