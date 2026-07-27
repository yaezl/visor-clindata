<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosAutorizacione
 * 
 * @property int $id
 * @property int|null $solicitud_de_compra_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminado_por_id
 * @property bool|null $autorizado
 * @property Carbon|null $autNivel1_en
 * @property string|null $autNivel1Tipo
 * @property Carbon|null $autNivel2_en
 * @property string|null $autNivel2Tipo
 * @property Carbon|null $autNivel3_en
 * @property string|null $autNivel3Tipo
 * @property Carbon|null $autNivel4_en
 * @property string|null $autNivel4Tipo
 * @property Carbon|null $autNivel5_en
 * @property string|null $autNivel5Tipo
 * @property string|null $motivo_rechazo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $autNivel1por_id
 * @property int|null $autNivel2por_id
 * @property int|null $autNivel3por_id
 * @property int|null $autNivel4por_id
 * @property int|null $autNivel5por_id
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosAutorizacione extends Model
{
	protected $table = 'suministros_Autorizaciones';
	public $timestamps = false;

	protected $casts = [
		'solicitud_de_compra_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminado_por_id' => 'int',
		'autorizado' => 'bool',
		'autNivel1_en' => 'datetime',
		'autNivel2_en' => 'datetime',
		'autNivel3_en' => 'datetime',
		'autNivel4_en' => 'datetime',
		'autNivel5_en' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'autNivel1por_id' => 'int',
		'autNivel2por_id' => 'int',
		'autNivel3por_id' => 'int',
		'autNivel4por_id' => 'int',
		'autNivel5por_id' => 'int'
	];

	protected $fillable = [
		'solicitud_de_compra_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminado_por_id',
		'autorizado',
		'autNivel1_en',
		'autNivel1Tipo',
		'autNivel2_en',
		'autNivel2Tipo',
		'autNivel3_en',
		'autNivel3Tipo',
		'autNivel4_en',
		'autNivel4Tipo',
		'autNivel5_en',
		'autNivel5Tipo',
		'motivo_rechazo',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'autNivel1por_id',
		'autNivel2por_id',
		'autNivel3por_id',
		'autNivel4por_id',
		'autNivel5por_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
