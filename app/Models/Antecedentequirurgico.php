<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Antecedentequirurgico
 * 
 * @property int $id
 * @property int|null $estudio_id
 * @property int|null $persona_id
 * @property int $personal_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string|null $comentario
 * @property Carbon|null $fecha_cirugia
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon $borrado_en
 * 
 * @property Estudio|null $estudio
 * @property Persona|null $persona
 * @property Personal $personal
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Antecedentequirurgico extends Model
{
	protected $table = 'antecedentequirurgico';
	public $timestamps = false;

	protected $casts = [
		'estudio_id' => 'int',
		'persona_id' => 'int',
		'personal_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'fecha_cirugia' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'estudio_id',
		'persona_id',
		'personal_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'comentario',
		'fecha_cirugia',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
