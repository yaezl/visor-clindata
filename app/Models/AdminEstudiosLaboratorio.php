<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminEstudiosLaboratorio
 * 
 * @property int $id
 * @property int|null $sectorlaboratorio_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $codigo
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property int|null $estudio_id
 * @property bool $predeterminado
 * @property int|null $orden
 * 
 * @property AdminSectorLaboratorio|null $admin_sector_laboratorio
 * @property Usuario|null $usuario
 * @property Estudio|null $estudio
 * @property Collection|AdminPruebasLaboratorio[] $admin_pruebas_laboratorios
 * @property Collection|EstudioexternoLaboratorio[] $estudioexterno_laboratorios
 * @property Collection|InternacionDetalleEstudiosInternacion[] $internacion_detalle_estudios_internacions
 * @property Collection|InternacionPerfilEstudiosLaboratorio[] $internacion_perfil_estudios_laboratorios
 *
 * @package App\Models
 */
class AdminEstudiosLaboratorio extends Model
{
	protected $table = 'admin_estudios_laboratorio';
	public $timestamps = false;

	protected $casts = [
		'sectorlaboratorio_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'estudio_id' => 'int',
		'predeterminado' => 'bool',
		'orden' => 'int'
	];

	protected $fillable = [
		'sectorlaboratorio_id',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'codigo',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'estudio_id',
		'predeterminado',
		'orden'
	];

	public function admin_sector_laboratorio()
	{
		return $this->belongsTo(AdminSectorLaboratorio::class, 'sectorlaboratorio_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function admin_pruebas_laboratorios()
	{
		return $this->hasMany(AdminPruebasLaboratorio::class, 'estudiosLaboratorio_id');
	}

	public function estudioexterno_laboratorios()
	{
		return $this->hasMany(EstudioexternoLaboratorio::class, 'estudio_id');
	}

	public function internacion_detalle_estudios_internacions()
	{
		return $this->hasMany(InternacionDetalleEstudiosInternacion::class, 'estudioLaboratorio_id');
	}

	public function internacion_perfil_estudios_laboratorios()
	{
		return $this->hasMany(InternacionPerfilEstudiosLaboratorio::class, 'estudiosLaboratorio_id');
	}
}
