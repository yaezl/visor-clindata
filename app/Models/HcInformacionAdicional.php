<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HcInformacionAdicional
 * 
 * @property int $id
 * @property int|null $evento_id
 * @property int|null $persona_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string $informacion_adicional
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $no_imprimir
 * 
 * @property Eventohc|null $eventohc
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class HcInformacionAdicional extends Model
{
	protected $table = 'hc_informacion_adicional';
	public $timestamps = false;

	protected $casts = [
		'evento_id' => 'int',
		'persona_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'no_imprimir' => 'bool'
	];

	protected $fillable = [
		'evento_id',
		'persona_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'informacion_adicional',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'no_imprimir'
	];

	public function eventohc()
	{
		return $this->belongsTo(Eventohc::class, 'evento_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
