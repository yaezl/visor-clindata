<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaVivienda
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $condiciontenencia_id
 * @property int|null $materialpredominante_id
 * @property int|null $calefaccionycocina_id
 * @property int|null $aguaprovienedesde_id
 * @property int|null $aguaextraedesde_id
 * @property int|null $desague_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $tipovivienda_id
 * @property int|null $nroCuartos
 * @property bool|null $pisoTierra
 * @property bool|null $comparteCama
 * @property bool|null $energiaElectrica
 * @property int|null $banio
 * @property bool|null $banioAfuera
 * @property string|null $observaciones
 * @property int|null $nroConvivientes
 * 
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 * @property TipoVivienda|null $tipo_vivienda
 * @property CondicionTenenciaVivienda|null $condicion_tenencia_vivienda
 * @property MaterialPredominanteVivienda|null $material_predominante_vivienda
 * @property CalefaccionYcocinaVivienda|null $calefaccion_ycocina_vivienda
 * @property AguaProvienedesdeVivienda|null $agua_provienedesde_vivienda
 * @property AguaExtraedesdeVivienda|null $agua_extraedesde_vivienda
 * @property DesagueVivienda|null $desague_vivienda
 *
 * @package App\Models
 */
class PersonaVivienda extends Model
{
	protected $table = 'persona_vivienda';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'condiciontenencia_id' => 'int',
		'materialpredominante_id' => 'int',
		'calefaccionycocina_id' => 'int',
		'aguaprovienedesde_id' => 'int',
		'aguaextraedesde_id' => 'int',
		'desague_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'tipovivienda_id' => 'int',
		'nroCuartos' => 'int',
		'pisoTierra' => 'bool',
		'comparteCama' => 'bool',
		'energiaElectrica' => 'bool',
		'banio' => 'int',
		'banioAfuera' => 'bool',
		'nroConvivientes' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'condiciontenencia_id',
		'materialpredominante_id',
		'calefaccionycocina_id',
		'aguaprovienedesde_id',
		'aguaextraedesde_id',
		'desague_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'tipovivienda_id',
		'nroCuartos',
		'pisoTierra',
		'comparteCama',
		'energiaElectrica',
		'banio',
		'banioAfuera',
		'observaciones',
		'nroConvivientes'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function tipo_vivienda()
	{
		return $this->belongsTo(TipoVivienda::class, 'tipovivienda_id');
	}

	public function condicion_tenencia_vivienda()
	{
		return $this->belongsTo(CondicionTenenciaVivienda::class, 'condiciontenencia_id');
	}

	public function material_predominante_vivienda()
	{
		return $this->belongsTo(MaterialPredominanteVivienda::class, 'materialpredominante_id');
	}

	public function calefaccion_ycocina_vivienda()
	{
		return $this->belongsTo(CalefaccionYcocinaVivienda::class, 'calefaccionycocina_id');
	}

	public function agua_provienedesde_vivienda()
	{
		return $this->belongsTo(AguaProvienedesdeVivienda::class, 'aguaprovienedesde_id');
	}

	public function agua_extraedesde_vivienda()
	{
		return $this->belongsTo(AguaExtraedesdeVivienda::class, 'aguaextraedesde_id');
	}

	public function desague_vivienda()
	{
		return $this->belongsTo(DesagueVivienda::class, 'desague_id');
	}
}
