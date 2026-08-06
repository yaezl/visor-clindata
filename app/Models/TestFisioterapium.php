<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestFisioterapium
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $signo_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $rom
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property SignoFisioterapium $signo_fisioterapium
 * @property Collection|Fisioterapium[] $fisioterapia
 *
 * @package App\Models
 */
class TestFisioterapium extends Model
{
	protected $table = 'test_fisioterapia';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'signo_id' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'signo_id',
		'nombre',
		'descripcion',
		'rom',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function signo_fisioterapium()
	{
		return $this->belongsTo(SignoFisioterapium::class, 'signo_id');
	}

	public function fisioterapia()
	{
		return $this->hasMany(Fisioterapium::class, 'test_id');
	}
}
