<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModulosFacturacion
 * 
 * @property int $id
 * @property string $nombre
 * @property float $precio
 * @property int $diasAplicableDesde
 * @property int|null $diasAplicableHasta
 * @property Carbon $createdAt
 * @property Carbon $modifiedAt
 * @property bool $borradoLogico
 * @property int $convenioId
 * @property int $createdBy
 * @property int $modifiedBy
 * 
 * @property Convenio $convenio
 * @property Usuario $usuario
 * @property Collection|Cotizacion[] $cotizacions
 * @property Collection|ItemBono[] $item_bonos
 * @property Collection|ModulosfacturacionPrestacion[] $modulosfacturacion_prestacions
 *
 * @package App\Models
 */
class ModulosFacturacion extends Model
{
	protected $table = 'modulos_facturacion';
	public $timestamps = false;

	protected $casts = [
		'precio' => 'float',
		'diasAplicableDesde' => 'int',
		'diasAplicableHasta' => 'int',
		'createdAt' => 'datetime',
		'modifiedAt' => 'datetime',
		'borradoLogico' => 'bool',
		'convenioId' => 'int',
		'createdBy' => 'int',
		'modifiedBy' => 'int'
	];

	protected $fillable = [
		'nombre',
		'precio',
		'diasAplicableDesde',
		'diasAplicableHasta',
		'createdAt',
		'modifiedAt',
		'borradoLogico',
		'convenioId',
		'createdBy',
		'modifiedBy'
	];

	public function convenio()
	{
		return $this->belongsTo(Convenio::class, 'convenioId');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modifiedBy');
	}

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class, 'moduloFacturacion_id');
	}

	public function item_bonos()
	{
		return $this->hasMany(ItemBono::class, 'moduloFacturacion_id');
	}

	public function modulosfacturacion_prestacions()
	{
		return $this->hasMany(ModulosfacturacionPrestacion::class, 'modulofacturacion_id');
	}
}
