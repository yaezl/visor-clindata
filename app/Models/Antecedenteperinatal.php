<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Antecedenteperinatal
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string|null $institucion_nacio
 * @property float|null $peso_al_nacer
 * @property int|null $edad_gestacional
 * @property float|null $talla
 * @property float|null $perimetro_cefalico
 * @property bool $sano
 * @property bool $con_patologia
 * @property bool $deprimido
 * @property bool $reanimacion
 * @property int|null $apgar_1
 * @property int|null $apgar_5
 * @property string|null $comentario
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $tipo_parto
 * @property string $pesquisa_neonatal
 * 
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 * @property Collection|AntecPerinatalDiagnostico[] $antec_perinatal_diagnosticos
 *
 * @package App\Models
 */
class Antecedenteperinatal extends Model
{
	protected $table = 'antecedenteperinatal';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'peso_al_nacer' => 'float',
		'edad_gestacional' => 'int',
		'talla' => 'float',
		'perimetro_cefalico' => 'float',
		'sano' => 'bool',
		'con_patologia' => 'bool',
		'deprimido' => 'bool',
		'reanimacion' => 'bool',
		'apgar_1' => 'int',
		'apgar_5' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'persona_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'institucion_nacio',
		'peso_al_nacer',
		'edad_gestacional',
		'talla',
		'perimetro_cefalico',
		'sano',
		'con_patologia',
		'deprimido',
		'reanimacion',
		'apgar_1',
		'apgar_5',
		'comentario',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'tipo_parto',
		'pesquisa_neonatal'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}

	public function antec_perinatal_diagnosticos()
	{
		return $this->hasMany(AntecPerinatalDiagnostico::class);
	}
}
