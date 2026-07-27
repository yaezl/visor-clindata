<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HojaConsumo
 * 
 * @property int $id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $parte_quirurgico_id
 * @property int|null $almacen_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property float $cantidad
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property InternacionParteQuirurgico|null $internacion_parte_quirurgico
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Almacen|null $almacen
 * @property Usuario|null $usuario
 * @property Collection|BonoHojaconsumo[] $bono_hojaconsumos
 *
 * @package App\Models
 */
class HojaConsumo extends Model
{
	protected $table = 'hoja_consumo';
	public $timestamps = false;

	protected $casts = [
		'articulotipopresentacion_id' => 'int',
		'parte_quirurgico_id' => 'int',
		'almacen_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'cantidad' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'articulotipopresentacion_id',
		'parte_quirurgico_id',
		'almacen_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'cantidad',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function internacion_parte_quirurgico()
	{
		return $this->belongsTo(InternacionParteQuirurgico::class, 'parte_quirurgico_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}

	public function bono_hojaconsumos()
	{
		return $this->hasMany(BonoHojaconsumo::class, 'hojaconsumo_id');
	}
}
