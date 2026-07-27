<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Antecedentepatologico
 * 
 * @property int $id
 * @property int|null $diagnostico_id
 * @property int|null $persona_id
 * @property string|null $comentario
 * @property int $personal_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon $borrado_en
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * 
 * @property Diagnostico|null $diagnostico
 * @property Persona|null $persona
 * @property Personal $personal
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Antecedentepatologico extends Model
{
	protected $table = 'antecedentepatologico';
	public $timestamps = false;

	protected $casts = [
		'diagnostico_id' => 'int',
		'persona_id' => 'int',
		'personal_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int'
	];

	protected $fillable = [
		'diagnostico_id',
		'persona_id',
		'comentario',
		'personal_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id'
	];

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
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
