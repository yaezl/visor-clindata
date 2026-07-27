<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prefactura
 * 
 * @property int $id
 * @property int|null $reemplazado_a_id
 * @property int|null $cuenta_id
 * @property int|null $institucion_id
 * @property int|null $estado_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property bool $a_facturar
 * @property Carbon $fecha
 * @property string|null $descripcion
 * @property string|null $motivo_cambio_estado
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property int|null $condicion_iva
 * @property bool|null $enviado
 * 
 * @property TipoPlan|null $tipo_plan
 * @property Prefactura|null $prefactura
 * @property Cuentum|null $cuentum
 * @property Institucion|null $institucion
 * @property Estadoprefactura|null $estadoprefactura
 * @property Usuario|null $usuario
 * @property Collection|Factura[] $facturas
 * @property Prefacturacriterio|null $prefacturacriterio
 * @property Collection|Prefacturaitem[] $prefacturaitems
 *
 * @package App\Models
 */
class Prefactura extends Model
{
	protected $table = 'prefactura';
	public $timestamps = false;

	protected $casts = [
		'reemplazado_a_id' => 'int',
		'cuenta_id' => 'int',
		'institucion_id' => 'int',
		'estado_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'a_facturar' => 'bool',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'condicion_iva' => 'int',
		'enviado' => 'bool'
	];

	protected $fillable = [
		'reemplazado_a_id',
		'cuenta_id',
		'institucion_id',
		'estado_id',
		'creadopor_id',
		'modificadopor_id',
		'a_facturar',
		'fecha',
		'descripcion',
		'motivo_cambio_estado',
		'creado_en',
		'modificado_en',
		'condicion_iva',
		'enviado'
	];

	public function tipo_plan()
	{
		return $this->belongsTo(TipoPlan::class, 'condicion_iva');
	}

	public function prefactura()
	{
		return $this->hasOne(Prefactura::class, 'reemplazado_a_id');
	}

	public function cuentum()
	{
		return $this->belongsTo(Cuentum::class, 'cuenta_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function estadoprefactura()
	{
		return $this->belongsTo(Estadoprefactura::class, 'estado_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificadopor_id');
	}

	public function facturas()
	{
		return $this->belongsToMany(Factura::class);
	}

	public function prefacturacriterio()
	{
		return $this->hasOne(Prefacturacriterio::class);
	}

	public function prefacturaitems()
	{
		return $this->hasMany(Prefacturaitem::class);
	}
}
