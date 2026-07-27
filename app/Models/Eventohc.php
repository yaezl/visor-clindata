<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Eventohc
 * 
 * @property int $id
 * @property int $tipocontenido_id
 * @property int|null $persona_id
 * @property int|null $parent_id
 * @property Carbon|null $fechahora
 * @property string $datos
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * 
 * @property Tipocontenido $tipocontenido
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 * @property Eventohc|null $eventohc
 * @property Collection|Consultum[] $consulta
 * @property Collection|Eventohc[] $eventohcs
 * @property Collection|HcInformacionAdicional[] $hc_informacion_adicionals
 * @property Collection|Informedeestudio[] $informedeestudios
 * @property Collection|InternacionPersona[] $internacion_personas
 * @property Collection|Solicitudturno[] $solicitudturnos
 *
 * @package App\Models
 */
class Eventohc extends Model
{
	use SoftDeletes;
	protected $table = 'eventohc';

	protected $casts = [
		'tipocontenido_id' => 'int',
		'persona_id' => 'int',
		'parent_id' => 'int',
		'fechahora' => 'datetime',
		'root' => 'int',
		'lft' => 'int',
		'rgt' => 'int',
		'lvl' => 'int',
		'deleted_by' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int'
	];

	protected $fillable = [
		'tipocontenido_id',
		'persona_id',
		'parent_id',
		'fechahora',
		'datos',
		'root',
		'lft',
		'rgt',
		'lvl',
		'deleted_by',
		'creadopor_id',
		'modificadopor_id'
	];

	public function tipocontenido()
	{
		return $this->belongsTo(Tipocontenido::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificadopor_id');
	}

	public function eventohc()
	{
		return $this->belongsTo(Eventohc::class, 'parent_id');
	}

	public function consulta()
	{
		return $this->hasMany(Consultum::class, 'evento_id');
	}

	public function eventohcs()
	{
		return $this->hasMany(Eventohc::class, 'parent_id');
	}

	public function hc_informacion_adicionals()
	{
		return $this->hasMany(HcInformacionAdicional::class, 'evento_id');
	}

	public function informedeestudios()
	{
		return $this->hasMany(Informedeestudio::class, 'evento_id');
	}

	public function internacion_personas()
	{
		return $this->hasMany(InternacionPersona::class, 'evento_id');
	}

	public function solicitudturnos()
	{
		return $this->hasMany(Solicitudturno::class, 'evento_id');
	}
}
