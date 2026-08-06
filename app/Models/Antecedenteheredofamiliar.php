<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Antecedenteheredofamiliar
 * 
 * @property int $id
 * @property int|null $diagnostico_id
 * @property int|null $persona_id
 * @property int $personal_id
 * @property int|null $familiarrol_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string|null $comentario
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon $borrado_en
 * 
 * @property Diagnostico|null $diagnostico
 * @property Persona|null $persona
 * @property Personal $personal
 * @property Familiarol|null $familiarol
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Antecedenteheredofamiliar extends Model
{
	protected $table = 'antecedenteheredofamiliar';
	public $timestamps = false;

	protected $casts = [
		'diagnostico_id' => 'int',
		'persona_id' => 'int',
		'personal_id' => 'int',
		'familiarrol_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'diagnostico_id',
		'persona_id',
		'personal_id',
		'familiarrol_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'comentario',
		'creado_en',
		'modificado_en',
		'borrado_en'
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

	public function familiarol()
	{
		return $this->belongsTo(Familiarol::class, 'familiarrol_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
