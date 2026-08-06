<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Centrodecosto
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string $numeroPrefijo
 * @property bool $es_os
 * @property bool $es_persona
 * @property bool $es_otro
 * @property int|null $institucion_id
 * @property bool $usa_efactura
 * @property bool $borrado_logico
 * @property string|null $perfil_facturacion_id
 * @property bool $usa_ticketera_fiscal
 * @property int|null $impresoraFiscal_id
 * @property string|null $perfil_facturacion_fce_id
 * @property string|null $tmpclase
 * 
 * @property Impresorafiscal|null $impresorafiscal
 * @property Usuario|null $usuario
 * @property Institucion|null $institucion
 * @property Collection|Caja[] $cajas
 * @property Collection|Documentofacturacion[] $documentofacturacions
 * @property Collection|Factura[] $facturas
 * @property Collection|Notacredito[] $notacreditos
 * @property Collection|Notadebito[] $notadebitos
 * @property Collection|Recibo[] $recibos
 * @property Collection|TokenSiat[] $token_siats
 *
 * @package App\Models
 */
class Centrodecosto extends Model
{
	protected $table = 'centrodecosto';
	public $timestamps = false;

	protected $casts = [
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'es_os' => 'bool',
		'es_persona' => 'bool',
		'es_otro' => 'bool',
		'institucion_id' => 'int',
		'usa_efactura' => 'bool',
		'borrado_logico' => 'bool',
		'usa_ticketera_fiscal' => 'bool',
		'impresoraFiscal_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'numeroPrefijo',
		'es_os',
		'es_persona',
		'es_otro',
		'institucion_id',
		'usa_efactura',
		'borrado_logico',
		'perfil_facturacion_id',
		'usa_ticketera_fiscal',
		'impresoraFiscal_id',
		'perfil_facturacion_fce_id',
		'tmpclase'
	];

	public function impresorafiscal()
	{
		return $this->belongsTo(Impresorafiscal::class, 'impresoraFiscal_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function cajas()
	{
		return $this->hasMany(Caja::class, 'centro_costo_id');
	}

	public function documentofacturacions()
	{
		return $this->hasMany(Documentofacturacion::class, 'centrodecostoDocumento_id');
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}

	public function notacreditos()
	{
		return $this->hasMany(Notacredito::class);
	}

	public function notadebitos()
	{
		return $this->hasMany(Notadebito::class);
	}

	public function recibos()
	{
		return $this->hasMany(Recibo::class);
	}

	public function token_siats()
	{
		return $this->hasMany(TokenSiat::class, 'centro_de_costo_id');
	}
}
