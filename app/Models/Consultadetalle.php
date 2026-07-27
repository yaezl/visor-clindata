<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consultadetalle
 * 
 * @property int $id
 * @property int|null $consulta_id
 * @property string $dtype
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $finalidad_consulta_id
 * @property int|null $causa_externa_id
 * @property int|null $incapacidad_id
 * @property string $cremiento_desarrollo
 * @property string $funciones_biologicas
 * @property string $sintomas_signos
 * @property Carbon|null $proxima_cita
 * 
 * @property FinalidadConsultaHc|null $finalidad_consulta_hc
 * @property IncapacidadHc|null $incapacidad_hc
 * @property CausaExternaHc|null $causa_externa_hc
 * @property Consultum|null $consultum
 * @property Usuario|null $usuario
 * @property Collection|Auditoriadetalle[] $auditoriadetalles
 * @property Dermatologium|null $dermatologium
 * @property Collection|DiagnosticoDetalle[] $diagnostico_detalles
 * @property Enfermerium|null $enfermerium
 * @property Informedeestudio|null $informedeestudio
 * @property Kinesiologium|null $kinesiologium
 * @property Notabasica|null $notabasica
 * @property Odontologium|null $odontologium
 * @property Oftalmologium|null $oftalmologium
 * @property Collection|Personalinterviniente[] $personalintervinientes
 * @property Saludmental|null $saludmental
 *
 * @package App\Models
 */
class Consultadetalle extends Model
{
	protected $table = 'consultadetalle';
	public $timestamps = false;

	protected $casts = [
		'consulta_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'finalidad_consulta_id' => 'int',
		'causa_externa_id' => 'int',
		'incapacidad_id' => 'int',
		'proxima_cita' => 'datetime'
	];

	protected $fillable = [
		'consulta_id',
		'dtype',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'finalidad_consulta_id',
		'causa_externa_id',
		'incapacidad_id',
		'cremiento_desarrollo',
		'funciones_biologicas',
		'sintomas_signos',
		'proxima_cita'
	];

	public function finalidad_consulta_hc()
	{
		return $this->belongsTo(FinalidadConsultaHc::class, 'finalidad_consulta_id');
	}

	public function incapacidad_hc()
	{
		return $this->belongsTo(IncapacidadHc::class, 'incapacidad_id');
	}

	public function causa_externa_hc()
	{
		return $this->belongsTo(CausaExternaHc::class, 'causa_externa_id');
	}

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}

	public function auditoriadetalles()
	{
		return $this->hasMany(Auditoriadetalle::class, 'detalle_id');
	}

	public function dermatologium()
	{
		return $this->hasOne(Dermatologium::class, 'id');
	}

	public function diagnostico_detalles()
	{
		return $this->hasMany(DiagnosticoDetalle::class, 'detalle_id');
	}

	public function enfermerium()
	{
		return $this->hasOne(Enfermerium::class, 'id');
	}

	public function informedeestudio()
	{
		return $this->hasOne(Informedeestudio::class, 'id');
	}

	public function kinesiologium()
	{
		return $this->hasOne(Kinesiologium::class, 'id');
	}

	public function notabasica()
	{
		return $this->hasOne(Notabasica::class, 'id');
	}

	public function odontologium()
	{
		return $this->hasOne(Odontologium::class, 'id');
	}

	public function oftalmologium()
	{
		return $this->hasOne(Oftalmologium::class, 'id');
	}

	public function personalintervinientes()
	{
		return $this->hasMany(Personalinterviniente::class, 'detalle_id');
	}

	public function saludmental()
	{
		return $this->hasOne(Saludmental::class, 'id');
	}
}
