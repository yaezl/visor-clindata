<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarjetadepago
 * 
 * @property int $id
 * @property int|null $banco_id
 * @property int|null $tipotarjetadepago_id
 * @property string $nombre
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $borrado_logico
 * @property int|null $marca_de_tarjetas_id
 * 
 * @property MarcaDeTarjeta|null $marca_de_tarjeta
 * @property Banco|null $banco
 * @property Tipotarjetadepago|null $tipotarjetadepago
 * @property Usuario|null $usuario
 * @property Collection|ConfiguracionCuota[] $configuracion_cuotas
 * @property Collection|MovimientoCaja[] $movimiento_cajas
 * @property Collection|Pagocontarjetacredito[] $pagocontarjetacreditos
 * @property Collection|Pagocontarjetadebito[] $pagocontarjetadebitos
 * @property Collection|Pagocontarjetaqr[] $pagocontarjetaqrs
 * @property Collection|SuministrosPagosDetalle[] $suministros_pagos_detalles
 *
 * @package App\Models
 */
class Tarjetadepago extends Model
{
	protected $table = 'tarjetadepago';
	public $timestamps = false;

	protected $casts = [
		'banco_id' => 'int',
		'tipotarjetadepago_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'marca_de_tarjetas_id' => 'int'
	];

	protected $fillable = [
		'banco_id',
		'tipotarjetadepago_id',
		'nombre',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'marca_de_tarjetas_id'
	];

	public function marca_de_tarjeta()
	{
		return $this->belongsTo(MarcaDeTarjeta::class, 'marca_de_tarjetas_id');
	}

	public function banco()
	{
		return $this->belongsTo(Banco::class);
	}

	public function tipotarjetadepago()
	{
		return $this->belongsTo(Tipotarjetadepago::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function configuracion_cuotas()
	{
		return $this->hasMany(ConfiguracionCuota::class);
	}

	public function movimiento_cajas()
	{
		return $this->hasMany(MovimientoCaja::class, 'tarjeta_id');
	}

	public function pagocontarjetacreditos()
	{
		return $this->hasMany(Pagocontarjetacredito::class);
	}

	public function pagocontarjetadebitos()
	{
		return $this->hasMany(Pagocontarjetadebito::class);
	}

	public function pagocontarjetaqrs()
	{
		return $this->hasMany(Pagocontarjetaqr::class, 'tarjetaDePago_id');
	}

	public function suministros_pagos_detalles()
	{
		return $this->hasMany(SuministrosPagosDetalle::class);
	}
}
