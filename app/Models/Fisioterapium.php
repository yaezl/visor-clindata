<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fisioterapium
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $test_id
 * @property int $persona_id
 * @property int $dolor
 * @property string $tipo
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property TestFisioterapium $test_fisioterapium
 * @property Usuario $usuario
 * @property Persona $persona
 *
 * @package App\Models
 */
class Fisioterapium extends Model
{
	protected $table = 'fisioterapia';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'test_id' => 'int',
		'persona_id' => 'int',
		'dolor' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'test_id',
		'persona_id',
		'dolor',
		'tipo',
		'borradoLogico'
	];

	public function test_fisioterapium()
	{
		return $this->belongsTo(TestFisioterapium::class, 'test_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
