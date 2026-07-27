<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Articulo
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property bool $descartable
 * @property bool $reactivo
 * @property bool $internacion
 * @property bool $ambulatorio
 * @property bool $disponible
 * @property string|null $accion_terapeutica
 * @property string|null $composicion
 * @property string|null $contra_indicaciones
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property bool $psicofarmaco
 * @property bool $estupefaciente
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property string|null $codigo_rafam
 * @property string|null $codigo_snomed
 * @property bool $bien_de_capital
 * @property bool $medicamento
 * @property bool $tipo_solucion
 * @property bool $medic_alto_riesgo
 * @property int|null $clave_kairos
 * @property bool $es_frio
 * 
 * @property Usuario|null $usuario
 * @property Collection|ArticuloTipoDetalle[] $articulo_tipo_detalles
 * @property Collection|Tipopresentacion[] $tipopresentacions
 *
 * @package App\Models
 */
class Articulo extends Model
{
	protected $table = 'articulo';
	public $timestamps = false;

	protected $casts = [
		'descartable' => 'bool',
		'reactivo' => 'bool',
		'internacion' => 'bool',
		'ambulatorio' => 'bool',
		'disponible' => 'bool',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'psicofarmaco' => 'bool',
		'estupefaciente' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'bien_de_capital' => 'bool',
		'medicamento' => 'bool',
		'tipo_solucion' => 'bool',
		'medic_alto_riesgo' => 'bool',
		'clave_kairos' => 'int',
		'es_frio' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'descartable',
		'reactivo',
		'internacion',
		'ambulatorio',
		'disponible',
		'accion_terapeutica',
		'composicion',
		'contra_indicaciones',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'psicofarmaco',
		'estupefaciente',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'codigo_rafam',
		'codigo_snomed',
		'bien_de_capital',
		'medicamento',
		'tipo_solucion',
		'medic_alto_riesgo',
		'clave_kairos',
		'es_frio'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function articulo_tipo_detalles()
	{
		return $this->hasMany(ArticuloTipoDetalle::class);
	}

	public function tipopresentacions()
	{
		return $this->belongsToMany(Tipopresentacion::class)
					->withPivot('id', 'tipounidadmedida_id', 'dosis', 'creado_por_id', 'modificado_por_id', 'eliminado_por_id', 'creado_en', 'modificado_en', 'borrado_en', 'borrado_logico', 'precio', 'codigo', 'troquel', 'codigo_barras', 'laboratorio', 'nombre_comercial', 'idUbicacionAlmacen');
	}
}
