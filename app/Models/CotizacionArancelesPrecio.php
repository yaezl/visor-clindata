<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CotizacionArancelesPrecio
 * 
 * @property int $id
 * @property int $created_by
 * @property int $cotizacion_id
 * @property int $arancel_id
 * @property float $precio
 * @property Carbon $created_at
 * 
 * @property Cotizacion $cotizacion
 * @property Usuario $usuario
 * @property Arancel $arancel
 *
 * @package App\Models
 */
class CotizacionArancelesPrecio extends Model
{
	protected $table = 'cotizacion_aranceles_precio';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'cotizacion_id' => 'int',
		'arancel_id' => 'int',
		'precio' => 'float'
	];

	protected $fillable = [
		'created_by',
		'cotizacion_id',
		'arancel_id',
		'precio'
	];

	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function arancel()
	{
		return $this->belongsTo(Arancel::class);
	}
}
