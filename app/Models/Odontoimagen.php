<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontoimagen
 * 
 * @property int $id
 * @property int|null $aplica_a_estado_id
 * @property int|null $aplica_a_id
 * @property int|null $archivo_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string $nombre
 * @property bool|null $izquierda
 * @property bool|null $medio
 * @property bool|null $derecha
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property int|null $posicion
 * 
 * @property Odontopracticaestado|null $odontopracticaestado
 * @property Odontopartedibujo|null $odontopartedibujo
 * @property Archivo|null $archivo
 * @property Usuario|null $usuario
 * @property Collection|Capituloodontodibujo[] $capituloodontodibujos
 * @property Collection|Capituloodontoestudiodibujo[] $capituloodontoestudiodibujos
 *
 * @package App\Models
 */
class Odontoimagen extends Model
{
	protected $table = 'odontoimagen';
	public $timestamps = false;

	protected $casts = [
		'aplica_a_estado_id' => 'int',
		'aplica_a_id' => 'int',
		'archivo_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'izquierda' => 'bool',
		'medio' => 'bool',
		'derecha' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'posicion' => 'int'
	];

	protected $fillable = [
		'aplica_a_estado_id',
		'aplica_a_id',
		'archivo_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'nombre',
		'izquierda',
		'medio',
		'derecha',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'posicion'
	];

	public function odontopracticaestado()
	{
		return $this->belongsTo(Odontopracticaestado::class, 'aplica_a_estado_id');
	}

	public function odontopartedibujo()
	{
		return $this->belongsTo(Odontopartedibujo::class, 'aplica_a_id');
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}

	public function capituloodontodibujos()
	{
		return $this->hasMany(Capituloodontodibujo::class, 'imagen_id');
	}

	public function capituloodontoestudiodibujos()
	{
		return $this->hasMany(Capituloodontoestudiodibujo::class, 'imagen_id');
	}
}
