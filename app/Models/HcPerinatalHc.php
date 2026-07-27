<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HcPerinatalHc
 * 
 * @property int $id
 * @property int|null $perinatal_id
 * @property int $consulta_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * 
 * @property HcPerinatal|null $hc_perinatal
 * @property Consultum $consultum
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class HcPerinatalHc extends Model
{
	protected $table = 'hc_perinatal_hc';
	public $timestamps = false;

	protected $casts = [
		'perinatal_id' => 'int',
		'consulta_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'perinatal_id',
		'consulta_id',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en'
	];

	public function hc_perinatal()
	{
		return $this->belongsTo(HcPerinatal::class, 'perinatal_id');
	}

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}
}
