<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Auditoriadiagnostico
 * 
 * @property int $id
 * @property int $consulta_id
 * @property int $diagnostico_id
 * @property int $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string|null $justificacion
 * @property bool $auditado
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Consultum $consultum
 * @property Diagnostico $diagnostico
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Auditoriadiagnostico extends Model
{
	protected $table = 'auditoriadiagnostico';
	public $timestamps = false;

	protected $casts = [
		'consulta_id' => 'int',
		'diagnostico_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'auditado' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'consulta_id',
		'diagnostico_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'justificacion',
		'auditado',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
