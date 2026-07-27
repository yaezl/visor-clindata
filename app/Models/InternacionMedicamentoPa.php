<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionMedicamentoPa
 * 
 * @property int $id
 * @property int|null $parteanestesico_id
 * @property int|null $articulotipopresentacion_id
 * @property int $cantidad
 * 
 * @property InternacionParteAnestesico|null $internacion_parte_anestesico
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Collection|BonoMedicamentopartequirurgico[] $bono_medicamentopartequirurgicos
 *
 * @package App\Models
 */
class InternacionMedicamentoPa extends Model
{
	protected $table = 'internacion_medicamento_pa';
	public $timestamps = false;

	protected $casts = [
		'parteanestesico_id' => 'int',
		'articulotipopresentacion_id' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'parteanestesico_id',
		'articulotipopresentacion_id',
		'cantidad'
	];

	public function internacion_parte_anestesico()
	{
		return $this->belongsTo(InternacionParteAnestesico::class, 'parteanestesico_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function bono_medicamentopartequirurgicos()
	{
		return $this->hasMany(BonoMedicamentopartequirurgico::class, 'medicamentopartequirurgico_id');
	}
}
