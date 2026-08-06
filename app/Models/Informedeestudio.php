<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Informedeestudio
 * 
 * @property int $id
 * @property int|null $estudio_id
 * @property string|null $informacion
 * @property bool $activo
 * @property int|null $evento_id
 * @property bool $informe_pendiente
 * @property string|null $informe
 * @property int|null $informadopor_id
 * @property Carbon|null $informe_fecha
 * @property int|null $ordendeestudio_id
 * @property string|null $numero_autorizacion
 * @property bool|null $enviado
 * @property bool $es_urgente
 * @property int|null $diagnostico_id
 * 
 * @property Diagnostico|null $diagnostico
 * @property Ordendeestudio|null $ordendeestudio
 * @property Usuario|null $usuario
 * @property Estudio|null $estudio
 * @property Consultadetalle $consultadetalle
 * @property Eventohc|null $eventohc
 * @property Collection|Bono[] $bonos
 * @property Collection|DermatologiaInformedeestudio[] $dermatologia_informedeestudios
 * @property Collection|InformarestudioArchivo[] $informarestudio_archivos
 * @property Collection|Archivo[] $archivos
 * @property Collection|Notabasica[] $notabasicas
 * @property Collection|OdontologiaInformedeestudio[] $odontologia_informedeestudios
 * @property Collection|OftalmologiaInformedeestudio[] $oftalmologia_informedeestudios
 * @property Collection|PersonainternacionInformedeestudio[] $personainternacion_informedeestudios
 * @property Collection|Saludmental[] $saludmentals
 *
 * @package App\Models
 */
class Informedeestudio extends Model
{
	protected $table = 'informedeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estudio_id' => 'int',
		'activo' => 'bool',
		'evento_id' => 'int',
		'informe_pendiente' => 'bool',
		'informadopor_id' => 'int',
		'informe_fecha' => 'datetime',
		'ordendeestudio_id' => 'int',
		'enviado' => 'bool',
		'es_urgente' => 'bool',
		'diagnostico_id' => 'int'
	];

	protected $fillable = [
		'estudio_id',
		'informacion',
		'activo',
		'evento_id',
		'informe_pendiente',
		'informe',
		'informadopor_id',
		'informe_fecha',
		'ordendeestudio_id',
		'numero_autorizacion',
		'enviado',
		'es_urgente',
		'diagnostico_id'
	];

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}

	public function ordendeestudio()
	{
		return $this->belongsTo(Ordendeestudio::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'informadopor_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function eventohc()
	{
		return $this->belongsTo(Eventohc::class, 'evento_id');
	}

	public function bonos()
	{
		return $this->belongsToMany(Bono::class);
	}

	public function dermatologia_informedeestudios()
	{
		return $this->hasMany(DermatologiaInformedeestudio::class);
	}

	public function informarestudio_archivos()
	{
		return $this->hasMany(InformarestudioArchivo::class);
	}

	public function archivos()
	{
		return $this->belongsToMany(Archivo::class, 'informedeestudio_archivo');
	}

	public function notabasicas()
	{
		return $this->belongsToMany(Notabasica::class, 'notabasica_informedeestudio');
	}

	public function odontologia_informedeestudios()
	{
		return $this->hasMany(OdontologiaInformedeestudio::class);
	}

	public function oftalmologia_informedeestudios()
	{
		return $this->hasMany(OftalmologiaInformedeestudio::class);
	}

	public function personainternacion_informedeestudios()
	{
		return $this->hasMany(PersonainternacionInformedeestudio::class);
	}

	public function saludmentals()
	{
		return $this->belongsToMany(Saludmental::class, 'saludmental_informedeestudio');
	}
}
