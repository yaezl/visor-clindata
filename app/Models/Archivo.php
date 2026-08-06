<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 * 
 * @property int $id
 * @property int|null $creadopor_id
 * @property int $codigo
 * @property string $directorio
 * @property string $extension
 * @property string $mimetype
 * @property string|null $comentario
 * @property Carbon $creado_en
 * @property int|null $eliminadopor_id
 * @property bool $activo
 * @property Carbon|null $borrado_en
 * @property string $nombre_sistema
 * @property string $nombre_original
 * 
 * @property Usuario|null $usuario
 * @property Collection|AdminNoticium[] $admin_noticia
 * @property Collection|AutorizacionesAutorizacion[] $autorizaciones_autorizacions
 * @property Collection|ConsentimientoConfigArchivo[] $consentimiento_config_archivos
 * @property Collection|ConsultaRecetaElectronica[] $consulta_receta_electronicas
 * @property Collection|Estudioexterno[] $estudioexternos
 * @property Collection|InformarestudioArchivo[] $informarestudio_archivos
 * @property Collection|Informedeestudio[] $informedeestudios
 * @property Collection|Institucion[] $institucions
 * @property Collection|ObraSocial[] $obra_socials
 * @property Collection|Odontoimagen[] $odontoimagens
 * @property Collection|Persona[] $personas
 * @property Collection|RudSeguimientoObraPublica[] $rud_seguimiento_obra_publicas
 * @property Collection|SubcategoriaObra[] $subcategoria_obras
 * @property Collection|SuministrosPresupuestosArchivo[] $suministros_presupuestos_archivos
 * @property Collection|TarjetaPortal[] $tarjeta_portals
 * @property Collection|Totem[] $totems
 *
 * @package App\Models
 */
class Archivo extends Model
{
	protected $table = 'archivo';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'codigo' => 'int',
		'creado_en' => 'datetime',
		'eliminadopor_id' => 'int',
		'activo' => 'bool',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'creadopor_id',
		'codigo',
		'directorio',
		'extension',
		'mimetype',
		'comentario',
		'creado_en',
		'eliminadopor_id',
		'activo',
		'borrado_en',
		'nombre_sistema',
		'nombre_original'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}

	public function admin_noticia()
	{
		return $this->hasMany(AdminNoticium::class, 'imagen_id');
	}

	public function autorizaciones_autorizacions()
	{
		return $this->belongsToMany(AutorizacionesAutorizacion::class, 'autorizaciones_autorizacion_archivo', 'archivo_id', 'autorizacion_id')
					->withPivot('id', 'created_by', 'modified_by', 'deleted_by', 'comentario', 'activo', 'tipo_archivo', 'deleted_at', 'borrado_logico')
					->withTimestamps();
	}

	public function consentimiento_config_archivos()
	{
		return $this->hasMany(ConsentimientoConfigArchivo::class, 'idArchivo');
	}

	public function consulta_receta_electronicas()
	{
		return $this->hasMany(ConsultaRecetaElectronica::class);
	}

	public function estudioexternos()
	{
		return $this->belongsToMany(Estudioexterno::class, 'estudioexterno_archivo', 'archivo_id', 'examenexterno_id');
	}

	public function informarestudio_archivos()
	{
		return $this->hasMany(InformarestudioArchivo::class);
	}

	public function informedeestudios()
	{
		return $this->belongsToMany(Informedeestudio::class, 'informedeestudio_archivo');
	}

	public function institucions()
	{
		return $this->hasMany(Institucion::class, 'logo_id');
	}

	public function obra_socials()
	{
		return $this->hasMany(ObraSocial::class, 'logo_id');
	}

	public function odontoimagens()
	{
		return $this->hasMany(Odontoimagen::class);
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'persona_archivo')
					->withPivot('id', 'creadopor_id', 'modificadopor_id', 'eliminado_por_id', 'comentario', 'activo', 'creado_en', 'modificado_en', 'borrado_en', 'tipo_archivo');
	}

	public function rud_seguimiento_obra_publicas()
	{
		return $this->hasMany(RudSeguimientoObraPublica::class);
	}

	public function subcategoria_obras()
	{
		return $this->hasMany(SubcategoriaObra::class);
	}

	public function suministros_presupuestos_archivos()
	{
		return $this->hasMany(SuministrosPresupuestosArchivo::class);
	}

	public function tarjeta_portals()
	{
		return $this->hasMany(TarjetaPortal::class, 'logo_id');
	}

	public function totems()
	{
		return $this->hasMany(Totem::class);
	}
}
