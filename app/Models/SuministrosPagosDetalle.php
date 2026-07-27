<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosPagosDetalle
 * 
 * @property int $id
 * @property int|null $pagos_cabecera_id
 * @property int|null $banco_id
 * @property int|null $tarjetadepago_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string $tipo
 * @property string $forma_pago
 * @property float $importe
 * @property string|null $descripcion
 * @property Carbon $fecha_pago
 * @property string|null $tipo_retencion
 * @property string|null $numero_cheque
 * @property string|null $nro_comprobante
 * @property string|null $cuenta_origen
 * @property string|null $titular_origen
 * @property string|null $tipo_tarjeta
 * @property int|null $cantidad_cuotas
 * @property string|null $nro_pagare
 * @property string|null $titular_pagare
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $cuentaEgreso_id
 * 
 * @property Banco|null $banco
 * @property Tarjetadepago|null $tarjetadepago
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosPagosDetalle extends Model
{
	protected $table = 'suministros_pagos_detalle';
	public $timestamps = false;

	protected $casts = [
		'pagos_cabecera_id' => 'int',
		'banco_id' => 'int',
		'tarjetadepago_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'importe' => 'float',
		'fecha_pago' => 'datetime',
		'cantidad_cuotas' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'cuentaEgreso_id' => 'int'
	];

	protected $fillable = [
		'pagos_cabecera_id',
		'banco_id',
		'tarjetadepago_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'tipo',
		'forma_pago',
		'importe',
		'descripcion',
		'fecha_pago',
		'tipo_retencion',
		'numero_cheque',
		'nro_comprobante',
		'cuenta_origen',
		'titular_origen',
		'tipo_tarjeta',
		'cantidad_cuotas',
		'nro_pagare',
		'titular_pagare',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'cuentaEgreso_id'
	];

	public function banco()
	{
		return $this->belongsTo(Banco::class);
	}

	public function tarjetadepago()
	{
		return $this->belongsTo(Tarjetadepago::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
