<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaIngreso
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $persona_internacion_id
 * @property int|null $atp_id
 * @property int|null $solucion_id
 * @property string $hora
 * @property float|null $cantidad
 * @property float|null $cantidad_paso
 * @property float|null $ritmo
 * @property float|null $oral
 * @property float|null $sng
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * 
 * @property InternacionPersona|null $internacion_persona
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaIngreso extends Model
{
	protected $table = 'internacion_hoja_enfermeria_ingresos';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'atp_id' => 'int',
		'solucion_id' => 'int',
		'cantidad' => 'float',
		'cantidad_paso' => 'float',
		'ritmo' => 'float',
		'oral' => 'float',
		'sng' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'persona_internacion_id',
		'atp_id',
		'solucion_id',
		'hora',
		'cantidad',
		'cantidad_paso',
		'ritmo',
		'oral',
		'sng',
		'creado_en',
		'modificado_en'
	];

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'solucion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}
}
