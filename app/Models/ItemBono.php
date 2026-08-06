<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemBono
 * 
 * @property int $id
 * @property int $bono_id
 * @property int|null $prestacion_id
 * @property int|null $estudio_id
 * @property int|null $reglas
 * @property int $cantidad
 * @property int $monto
 * @property int|null $item_bono_related
 * @property Carbon|null $fechaRealizado
 * @property int|null $moduloFacturacion_id
 * @property int|null $piezaDentaria
 * @property string|null $cara_pieza_dentaria
 * 
 * @property ModulosFacturacion|null $modulos_facturacion
 * @property Prestacion|null $prestacion
 * @property Estudio|null $estudio
 * @property Bono $bono
 * @property ItemRegla|null $item_regla
 * @property Collection|BrokerInfo[] $broker_infos
 * @property Collection|DebitosYCredito[] $debitos_y_creditos
 * @property Collection|ItemArancelPrecio[] $item_arancel_precios
 * @property TedefOdontoBonoitem|null $tedef_odonto_bonoitem
 *
 * @package App\Models
 */
class ItemBono extends Model
{
	protected $table = 'item_bono';
	public $timestamps = false;

	protected $casts = [
		'bono_id' => 'int',
		'prestacion_id' => 'int',
		'estudio_id' => 'int',
		'reglas' => 'int',
		'cantidad' => 'int',
		'monto' => 'int',
		'item_bono_related' => 'int',
		'fechaRealizado' => 'datetime',
		'moduloFacturacion_id' => 'int',
		'piezaDentaria' => 'int'
	];

	protected $fillable = [
		'bono_id',
		'prestacion_id',
		'estudio_id',
		'reglas',
		'cantidad',
		'monto',
		'item_bono_related',
		'fechaRealizado',
		'moduloFacturacion_id',
		'piezaDentaria',
		'cara_pieza_dentaria'
	];

	public function modulos_facturacion()
	{
		return $this->belongsTo(ModulosFacturacion::class, 'moduloFacturacion_id');
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}

	public function item_regla()
	{
		return $this->belongsTo(ItemRegla::class, 'reglas');
	}

	public function broker_infos()
	{
		return $this->hasMany(BrokerInfo::class);
	}

	public function debitos_y_creditos()
	{
		return $this->hasMany(DebitosYCredito::class);
	}

	public function item_arancel_precios()
	{
		return $this->hasMany(ItemArancelPrecio::class, 'itemBono_id');
	}

	public function tedef_odonto_bonoitem()
	{
		return $this->hasOne(TedefOdontoBonoitem::class, 'itembono_id');
	}
}
