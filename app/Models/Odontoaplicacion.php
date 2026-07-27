<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontoaplicacion
 * 
 * @property int $id
 * @property int|null $capituloodontologia_id
 * @property int|null $capituloestudio_id
 * @property int|null $estado_id
 * @property int|null $parteboca_id
 * @property int|null $persona_id
 * @property int|null $consultaodontologica_id
 * @property int|null $consulta_elimina_id
 * @property int|null $consulta_cambioestado_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property Carbon|null $fecha_cambio_estado
 * @property bool $agrego_practica
 * @property bool $borrado_logico
 * 
 * @property Capituloodontologium|null $capituloodontologium
 * @property Usuario|null $usuario
 * @property CapituloodontologiaEstudio|null $capituloodontologia_estudio
 * @property Odontopracticaestado|null $odontopracticaestado
 * @property Odontoparteboca|null $odontoparteboca
 * @property Persona|null $persona
 * @property Odontologium|null $odontologium
 * @property Collection|Odontopiezainvolucrada[] $odontopiezainvolucradas
 *
 * @package App\Models
 */
class Odontoaplicacion extends Model
{
	protected $table = 'odontoaplicacion';
	public $timestamps = false;

	protected $casts = [
		'capituloodontologia_id' => 'int',
		'capituloestudio_id' => 'int',
		'estado_id' => 'int',
		'parteboca_id' => 'int',
		'persona_id' => 'int',
		'consultaodontologica_id' => 'int',
		'consulta_elimina_id' => 'int',
		'consulta_cambioestado_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'fecha_cambio_estado' => 'datetime',
		'agrego_practica' => 'bool',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'capituloodontologia_id',
		'capituloestudio_id',
		'estado_id',
		'parteboca_id',
		'persona_id',
		'consultaodontologica_id',
		'consulta_elimina_id',
		'consulta_cambioestado_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'fecha_cambio_estado',
		'agrego_practica',
		'borrado_logico'
	];

	public function capituloodontologium()
	{
		return $this->belongsTo(Capituloodontologium::class, 'capituloodontologia_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function capituloodontologia_estudio()
	{
		return $this->belongsTo(CapituloodontologiaEstudio::class, 'capituloestudio_id');
	}

	public function odontopracticaestado()
	{
		return $this->belongsTo(Odontopracticaestado::class, 'estado_id');
	}

	public function odontoparteboca()
	{
		return $this->belongsTo(Odontoparteboca::class, 'parteboca_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function odontologium()
	{
		return $this->belongsTo(Odontologium::class, 'consulta_cambioestado_id');
	}

	public function odontopiezainvolucradas()
	{
		return $this->hasMany(Odontopiezainvolucrada::class);
	}
}
