<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaEgreso
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $persona_internacion_id
 * @property float|null $sng
 * @property float|null $orina
 * @property float|null $diuresis
 * @property float|null $catarsis
 * @property float|null $djemed
 * @property float|null $djepde
 * @property float|null $djepiz
 * @property bool $es_balance
 * @property string|null $hora
 * @property string|null $balance
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property float|null $djeabd
 * @property float|null $djeblr
 * @property float|null $total
 * @property string $otr
 * @property float|null $cantidadOtros
 * 
 * @property InternacionPersona|null $internacion_persona
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaEgreso extends Model
{
	protected $table = 'internacion_hoja_enfermeria_egresos';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'sng' => 'float',
		'orina' => 'float',
		'diuresis' => 'float',
		'catarsis' => 'float',
		'djemed' => 'float',
		'djepde' => 'float',
		'djepiz' => 'float',
		'es_balance' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'djeabd' => 'float',
		'djeblr' => 'float',
		'total' => 'float',
		'cantidadOtros' => 'float'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'persona_internacion_id',
		'sng',
		'orina',
		'diuresis',
		'catarsis',
		'djemed',
		'djepde',
		'djepiz',
		'es_balance',
		'hora',
		'balance',
		'creado_en',
		'modificado_en',
		'djeabd',
		'djeblr',
		'total',
		'otr',
		'cantidadOtros'
	];

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}
}
