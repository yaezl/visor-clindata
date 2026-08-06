<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estudioexterno
 * 
 * @property int $id
 * @property string|null $comentario
 * @property int|null $categoria_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property int|null $persona_id
 * @property int|null $eliminado_por_id
 * @property bool $activo
 * @property Carbon|null $borrado_en
 * @property int|null $departamento_id
 * @property Carbon $fecha
 * @property int|null $institucion_id
 * @property int|null $estudio_id
 * 
 * @property Estudio|null $estudio
 * @property Institucion|null $institucion
 * @property Persona|null $persona
 * @property Categoriaestudiosexterno|null $categoriaestudiosexterno
 * @property Usuario|null $usuario
 * @property Departamento|null $departamento
 * @property Collection|Archivo[] $archivos
 *
 * @package App\Models
 */
class Estudioexterno extends Model
{
	protected $table = 'estudioexterno';
	public $timestamps = false;

	protected $casts = [
		'categoria_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'persona_id' => 'int',
		'eliminado_por_id' => 'int',
		'activo' => 'bool',
		'borrado_en' => 'datetime',
		'departamento_id' => 'int',
		'fecha' => 'datetime',
		'institucion_id' => 'int',
		'estudio_id' => 'int'
	];

	protected $fillable = [
		'comentario',
		'categoria_id',
		'creadopor_id',
		'modificadopor_id',
		'creado_en',
		'modificado_en',
		'persona_id',
		'eliminado_por_id',
		'activo',
		'borrado_en',
		'departamento_id',
		'fecha',
		'institucion_id',
		'estudio_id'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function categoriaestudiosexterno()
	{
		return $this->belongsTo(Categoriaestudiosexterno::class, 'categoria_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function departamento()
	{
		return $this->belongsTo(Departamento::class);
	}

	public function archivos()
	{
		return $this->belongsToMany(Archivo::class, 'estudioexterno_archivo', 'examenexterno_id');
	}
}
