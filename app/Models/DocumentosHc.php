<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentosHc
 * 
 * @property int $id
 * @property int|null $personal_id
 * @property int|null $paciente_id
 * @property string $documento_id
 * @property string $documento_clase
 * @property string|null $documento_nombre
 * @property string|null $documento_firmado
 * @property Carbon $fecha_documento
 * @property string $estado
 * 
 * @property Personal|null $personal
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class DocumentosHc extends Model
{
	protected $table = 'documentos_hc';
	public $timestamps = false;

	protected $casts = [
		'personal_id' => 'int',
		'paciente_id' => 'int',
		'fecha_documento' => 'datetime'
	];

	protected $fillable = [
		'personal_id',
		'paciente_id',
		'documento_id',
		'documento_clase',
		'documento_nombre',
		'documento_firmado',
		'fecha_documento',
		'estado'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'paciente_id');
	}
}
