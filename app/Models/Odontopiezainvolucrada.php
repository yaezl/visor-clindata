<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontopiezainvolucrada
 * 
 * @property int $id
 * @property int|null $odontoaplicacion_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property int $diente
 * @property bool $cara_superior
 * @property bool $cara_central
 * @property bool $cara_izquierda
 * @property bool $cara_derecha
 * @property bool $cara_inferior
 * @property bool $pieza_completa
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Odontoaplicacion|null $odontoaplicacion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Odontopiezainvolucrada extends Model
{
	protected $table = 'odontopiezainvolucrada';
	public $timestamps = false;

	protected $casts = [
		'odontoaplicacion_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'diente' => 'int',
		'cara_superior' => 'bool',
		'cara_central' => 'bool',
		'cara_izquierda' => 'bool',
		'cara_derecha' => 'bool',
		'cara_inferior' => 'bool',
		'pieza_completa' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'odontoaplicacion_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'diente',
		'cara_superior',
		'cara_central',
		'cara_izquierda',
		'cara_derecha',
		'cara_inferior',
		'pieza_completa',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function odontoaplicacion()
	{
		return $this->belongsTo(Odontoaplicacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
