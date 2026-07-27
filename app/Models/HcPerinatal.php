<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HcPerinatal
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int $basicos_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Persona|null $persona
 * @property HcPerinatalDatosBasico $hc_perinatal_datos_basico
 * @property Usuario|null $usuario
 * @property Collection|HcPerinatalHc[] $hc_perinatal_hcs
 *
 * @package App\Models
 */
class HcPerinatal extends Model
{
	protected $table = 'hc_perinatal';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'basicos_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'persona_id',
		'basicos_id',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function hc_perinatal_datos_basico()
	{
		return $this->belongsTo(HcPerinatalDatosBasico::class, 'basicos_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function hc_perinatal_hcs()
	{
		return $this->hasMany(HcPerinatalHc::class, 'perinatal_id');
	}
}
