<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Documento
 * 
 * @property int $id
 * @property string $dtype
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property int|null $tipodocumento_id
 * @property string|null $codigo_ad_hoc
 * @property bool $enviado
 * 
 * @property Usuario|null $usuario
 * @property CuentasTipodocumento|null $cuentas_tipodocumento
 * @property Anulacionfactura|null $anulacionfactura
 * @property Anulacionrecibo|null $anulacionrecibo
 * @property CancelacionDocumento|null $cancelacion_documento
 * @property Documentofacturacion|null $documentofacturacion
 * @property Documentorecibo|null $documentorecibo
 * @property Envioaalmacen|null $envioaalmacen
 * @property Envioapersona|null $envioapersona
 * @property Factura|null $factura
 * @property Collection|Movimiento[] $movimientos
 * @property Notacredito|null $notacredito
 * @property Notadebito|null $notadebito
 * @property Recepcionalmacen|null $recepcionalmacen
 * @property Recibo|null $recibo
 * @property StkEnvioaalmacen|null $stk_envioaalmacen
 * @property StkEnvioapersona|null $stk_envioapersona
 * @property StkRecepcionalmacen|null $stk_recepcionalmacen
 *
 * @package App\Models
 */
class Documento extends Model
{
	protected $table = 'documento';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'tipodocumento_id' => 'int',
		'enviado' => 'bool'
	];

	protected $fillable = [
		'dtype',
		'creadopor_id',
		'modificadopor_id',
		'creado_en',
		'modificado_en',
		'tipodocumento_id',
		'codigo_ad_hoc',
		'enviado'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificadopor_id');
	}

	public function cuentas_tipodocumento()
	{
		return $this->belongsTo(CuentasTipodocumento::class, 'tipodocumento_id');
	}

	public function anulacionfactura()
	{
		return $this->hasOne(Anulacionfactura::class, 'id');
	}

	public function anulacionrecibo()
	{
		return $this->hasOne(Anulacionrecibo::class, 'id');
	}

	public function cancelacion_documento()
	{
		return $this->hasOne(CancelacionDocumento::class, 'id');
	}

	public function documentofacturacion()
	{
		return $this->hasOne(Documentofacturacion::class, 'id');
	}

	public function documentorecibo()
	{
		return $this->hasOne(Documentorecibo::class, 'id');
	}

	public function envioaalmacen()
	{
		return $this->hasOne(Envioaalmacen::class, 'id');
	}

	public function envioapersona()
	{
		return $this->hasOne(Envioapersona::class, 'id');
	}

	public function factura()
	{
		return $this->hasOne(Factura::class, 'id');
	}

	public function movimientos()
	{
		return $this->hasMany(Movimiento::class);
	}

	public function notacredito()
	{
		return $this->hasOne(Notacredito::class, 'id');
	}

	public function notadebito()
	{
		return $this->hasOne(Notadebito::class, 'id');
	}

	public function recepcionalmacen()
	{
		return $this->hasOne(Recepcionalmacen::class, 'id');
	}

	public function recibo()
	{
		return $this->hasOne(Recibo::class, 'id');
	}

	public function stk_envioaalmacen()
	{
		return $this->hasOne(StkEnvioaalmacen::class, 'id');
	}

	public function stk_envioapersona()
	{
		return $this->hasOne(StkEnvioapersona::class, 'id');
	}

	public function stk_recepcionalmacen()
	{
		return $this->hasOne(StkRecepcionalmacen::class, 'id');
	}
}
