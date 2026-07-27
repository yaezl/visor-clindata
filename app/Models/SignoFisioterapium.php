<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SignoFisioterapium
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $diagnostico_id
 * @property string $nombre
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property Diagnostico $diagnostico
 * @property Collection|TestFisioterapium[] $test_fisioterapia
 *
 * @package App\Models
 */
class SignoFisioterapium extends Model
{
	protected $table = 'signo_fisioterapia';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'diagnostico_id' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'diagnostico_id',
		'nombre',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}

	public function test_fisioterapia()
	{
		return $this->hasMany(TestFisioterapium::class, 'signo_id');
	}
}
