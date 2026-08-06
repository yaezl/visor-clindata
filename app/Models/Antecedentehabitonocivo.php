<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Antecedentehabitonocivo
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property bool|null $tabaco
 * @property bool|null $alcohol
 * @property bool|null $drogas
 * @property bool|null $otros
 * @property bool $borrado_logico
 * @property Carbon $createdAt
 * @property Carbon $modifiedAt
 * @property string|null $comentarioTabaco
 * @property string|null $comentarioAlcohol
 * @property string|null $comentarioDrogas
 * @property string|null $comentarioOtros
 * 
 * @property Usuario|null $usuario
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class Antecedentehabitonocivo extends Model
{
	protected $table = 'antecedentehabitonocivo';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'tabaco' => 'bool',
		'alcohol' => 'bool',
		'drogas' => 'bool',
		'otros' => 'bool',
		'borrado_logico' => 'bool',
		'createdAt' => 'datetime',
		'modifiedAt' => 'datetime'
	];

	protected $fillable = [
		'persona_id',
		'creadopor_id',
		'modificadopor_id',
		'tabaco',
		'alcohol',
		'drogas',
		'otros',
		'borrado_logico',
		'createdAt',
		'modifiedAt',
		'comentarioTabaco',
		'comentarioAlcohol',
		'comentarioDrogas',
		'comentarioOtros'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
