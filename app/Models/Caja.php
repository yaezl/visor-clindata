<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Caja
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $institucion_id
 * @property int|null $centro_costo_id
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * @property string|null $qr_cobro
 * 
 * @property Usuario|null $usuario
 * @property Centrodecosto|null $centrodecosto
 * @property Institucion|null $institucion
 * @property Collection|Factura[] $facturas
 * @property Collection|MovimientoCaja[] $movimiento_cajas
 * @property Collection|Notacredito[] $notacreditos
 * @property Collection|Recibo[] $recibos
 *
 * @package App\Models
 */
class Caja extends Model
{
	protected $table = 'caja';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'institucion_id' => 'int',
		'centro_costo_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'institucion_id',
		'centro_costo_id',
		'nombre',
		'codigo',
		'borrado_logico',
		'qr_cobro'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function centrodecosto()
	{
		return $this->belongsTo(Centrodecosto::class, 'centro_costo_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}

	public function movimiento_cajas()
	{
		return $this->hasMany(MovimientoCaja::class);
	}

	public function notacreditos()
	{
		return $this->hasMany(Notacredito::class);
	}

	public function recibos()
	{
		return $this->hasMany(Recibo::class);
	}
}
