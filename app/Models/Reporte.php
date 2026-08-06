<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reporte
 * 
 * @property int $id
 * @property int|null $tipo_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $controlador_path
 * @property bool $es_default
 * @property bool $es_template_default
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property string $codigo
 * 
 * @property Tiporeporte|null $tiporeporte
 * @property Usuario|null $usuario
 * @property Collection|Reporteconfig[] $reporteconfigs
 *
 * @package App\Models
 */
class Reporte extends Model
{
	protected $table = 'reporte';
	public $timestamps = false;

	protected $casts = [
		'tipo_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'es_default' => 'bool',
		'es_template_default' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'tipo_id',
		'creadopor_id',
		'modificadopor_id',
		'nombre',
		'descripcion',
		'controlador_path',
		'es_default',
		'es_template_default',
		'creado_en',
		'modificado_en',
		'codigo'
	];

	public function tiporeporte()
	{
		return $this->belongsTo(Tiporeporte::class, 'tipo_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificadopor_id');
	}

	public function reporteconfigs()
	{
		return $this->hasMany(Reporteconfig::class);
	}
}
