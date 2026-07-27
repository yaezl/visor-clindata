<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Medicion
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property float|null $tension_arterial_minima
 * @property float|null $tension_arterial_maxima
 * @property float|null $peso
 * @property float|null $talla
 * @property float|null $perimetro_encefalico
 * @property float|null $temperatura
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property float|null $f_card
 * @property float|null $f_resp
 * @property float|null $sato
 * @property float|null $hgt
 * @property float|null $pmusculo
 * @property float|null $pgrasa
 * @property string|null $musculo
 * 
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 * @property Collection|Dermatologium[] $dermatologia
 * @property Collection|Enfermerium[] $enfermeria
 * @property Collection|Notabasica[] $notabasicas
 * @property Collection|Oftalmologium[] $oftalmologia
 *
 * @package App\Models
 */
class Medicion extends Model
{
	protected $table = 'medicion';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'tension_arterial_minima' => 'float',
		'tension_arterial_maxima' => 'float',
		'peso' => 'float',
		'talla' => 'float',
		'perimetro_encefalico' => 'float',
		'temperatura' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'f_card' => 'float',
		'f_resp' => 'float',
		'sato' => 'float',
		'hgt' => 'float',
		'pmusculo' => 'float',
		'pgrasa' => 'float'
	];

	protected $fillable = [
		'persona_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'tension_arterial_minima',
		'tension_arterial_maxima',
		'peso',
		'talla',
		'perimetro_encefalico',
		'temperatura',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'f_card',
		'f_resp',
		'sato',
		'hgt',
		'pmusculo',
		'pgrasa',
		'musculo'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}

	public function dermatologia()
	{
		return $this->hasMany(Dermatologium::class);
	}

	public function enfermeria()
	{
		return $this->hasMany(Enfermerium::class);
	}

	public function notabasicas()
	{
		return $this->hasMany(Notabasica::class);
	}

	public function oftalmologia()
	{
		return $this->hasMany(Oftalmologium::class);
	}
}
