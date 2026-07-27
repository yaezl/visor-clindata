<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Usuario
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int $personal_id
 * @property bool $borrado_logico
 * @property Carbon|null $last_login
 * @property int $log_attempt
 * @property bool $blocked_account
 * @property string|null $codigo_ad_hoc
 * @property bool $cambiar_password
 * 
 * @property Personal $personal
 * @property Collection|ExtensionVigenciaSited[] $extension_vigencia_siteds
 * @property Collection|AdminAmbitoHecho[] $admin_ambito_hechos
 * @property Collection|AdminAmbitoHechoPrivado[] $admin_ambito_hecho_privados
 * @property Collection|AdminConfiguracionTemporal[] $admin_configuracion_temporals
 * @property Collection|AdminCriterioComparacion[] $admin_criterio_comparacions
 * @property Collection|AdminEstudiosLaboratorio[] $admin_estudios_laboratorios
 * @property Collection|AdminGestion[] $admin_gestions
 * @property Collection|AdminGrupoDeRiesgo[] $admin_grupo_de_riesgos
 * @property Collection|AdminMetodoAnticonceptivo[] $admin_metodo_anticonceptivos
 * @property Collection|AdminNoticium[] $admin_noticia
 * @property Collection|AdminOrigenAtencion[] $admin_origen_atencions
 * @property Collection|Permiso[] $permisos
 * @property Collection|AdminPruebasLaboratorio[] $admin_pruebas_laboratorios
 * @property Collection|AdminSectorLaboratorio[] $admin_sector_laboratorios
 * @property Collection|AdminTipoPeriodo[] $admin_tipo_periodos
 * @property Collection|AdminTratamientoHormonal[] $admin_tratamiento_hormonals
 * @property Collection|AdminTurnoEnfermerium[] $admin_turno_enfermeria
 * @property Collection|AdminWsApiUsuarioPaciente[] $admin_ws_api_usuario_pacientes
 * @property Collection|AdmisionAsignacionauditorium[] $admision_asignacionauditoria
 * @property Collection|AgenciaFinancium[] $agencia_financia
 * @property Collection|AguaExtraedesdeVivienda[] $agua_extraedesde_viviendas
 * @property Collection|AguaProvienedesdeVivienda[] $agua_provienedesde_viviendas
 * @property Collection|Almacen[] $almacens
 * @property Collection|AntecedenteNOpatologico[] $antecedente_n_opatologicos
 * @property Collection|Antecedentehabitonocivo[] $antecedentehabitonocivos
 * @property Collection|Antecedenteheredofamiliar[] $antecedenteheredofamiliars
 * @property Collection|Antecedentenutricionalpediatrico[] $antecedentenutricionalpediatricos
 * @property Collection|Antecedentepatologico[] $antecedentepatologicos
 * @property Collection|Antecedenteperinatal[] $antecedenteperinatals
 * @property Collection|Antecedentequirurgico[] $antecedentequirurgicos
 * @property Collection|ArancelMedico[] $arancel_medicos
 * @property Collection|Archivo[] $archivos
 * @property Collection|AreaPrivada[] $area_privadas
 * @property Collection|AreaServicio[] $area_servicios
 * @property Collection|Articulo[] $articulos
 * @property Collection|ArticuloTipopresentacion[] $articulo_tipopresentacions
 * @property Collection|Articuloalmacenminmax[] $articuloalmacenminmaxes
 * @property Collection|Articulocronico[] $articulocronicos
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 * @property Collection|ArticulotpPrestacion[] $articulotp_prestacions
 * @property Collection|AuditoriaReservaQuirofano[] $auditoria_reserva_quirofanos
 * @property Collection|AuditoriaVideoconsultum[] $auditoria_videoconsulta
 * @property Collection|Auditoriadiagnostico[] $auditoriadiagnosticos
 * @property Collection|AutomaticHook[] $automatic_hooks
 * @property Collection|AutorizacionesAprobacion[] $autorizaciones_aprobacions
 * @property Collection|AutorizacionesAuditoriaEstado[] $autorizaciones_auditoria_estados
 * @property Collection|AutorizacionesAutorizacionArchivo[] $autorizaciones_autorizacion_archivos
 * @property Collection|AutorizacionesDiagnostico[] $autorizaciones_diagnosticos
 * @property Collection|AutorizacionesEstado[] $autorizaciones_estados
 * @property Collection|AutorizacionesMedicacion[] $autorizaciones_medicacions
 * @property Collection|AutorizacionesNota[] $autorizaciones_notas
 * @property Collection|AutorizacionesNotasAuditorFacturacion[] $autorizaciones_notas_auditor_facturacions
 * @property Collection|AutorizacionesNotasPractica[] $autorizaciones_notas_practicas
 * @property Collection|AutorizacionesPlanAtpTipocobertura[] $autorizaciones_plan_atp_tipocoberturas
 * @property Collection|AutorizacionesPractica[] $autorizaciones_practicas
 * @property Collection|AutorizacionesReintegro[] $autorizaciones_reintegros
 * @property Collection|AutorizacionesReintegroEstudio[] $autorizaciones_reintegro_estudios
 * @property Collection|AutorizacionesReintegroMedicamento[] $autorizaciones_reintegro_medicamentos
 * @property Collection|AutorizacionesTipoCobertura[] $autorizaciones_tipo_coberturas
 * @property Collection|AutorizacionesTipoPrestacion[] $autorizaciones_tipo_prestacions
 * @property Collection|Banco[] $bancos
 * @property Collection|Bono[] $bonos
 * @property Collection|BrokerConfig[] $broker_configs
 * @property Collection|Caja[] $cajas
 * @property Collection|CalefaccionYcocinaVivienda[] $calefaccion_ycocina_viviendas
 * @property Collection|CambioEstadoTurno[] $cambio_estado_turnos
 * @property Collection|CancelacionOrigen[] $cancelacion_origens
 * @property Collection|Capituloodontologium[] $capituloodontologia
 * @property Collection|CapituloodontologiaEstudio[] $capituloodontologia_estudios
 * @property Collection|CategoriaObra[] $categoria_obras
 * @property Collection|CategoriaSubcategorium[] $categoria_subcategoria
 * @property Collection|Categoriaobrasocial[] $categoriaobrasocials
 * @property Collection|CausaBloqueo[] $causa_bloqueos
 * @property Collection|CausaHcPasiva[] $causa_hc_pasivas
 * @property Collection|Centrodecosto[] $centrodecostos
 * @property Collection|ConceptoCompensatorio[] $concepto_compensatorios
 * @property Collection|CondicionIva[] $condicion_ivas
 * @property Collection|CondicionTenenciaVivienda[] $condicion_tenencia_viviendas
 * @property Collection|Config[] $configs
 * @property Collection|ConfiguracionCuota[] $configuracion_cuotas
 * @property Collection|ConsentimientoInformadoConfig[] $consentimiento_informado_configs
 * @property Collection|ConsultaMedicionGinecologium[] $consulta_medicion_ginecologia
 * @property Collection|Consultadetalle[] $consultadetalles
 * @property Collection|ConvenioPrestador[] $convenio_prestadors
 * @property Collection|Conversion[] $conversions
 * @property Collection|CotizacionArancelesPrecio[] $cotizacion_aranceles_precios
 * @property Collection|CriteriosDeReprogramacion[] $criterios_de_reprogramacions
 * @property Collection|DebitosYCredito[] $debitos_y_creditos
 * @property Collection|DeclaracionEtiqueta[] $declaracion_etiquetas
 * @property Collection|DependenciaSubCategorium[] $dependencia_sub_categoria
 * @property Collection|Derivacion[] $derivacions
 * @property Collection|DesagueVivienda[] $desague_viviendas
 * @property Collection|Descuento[] $descuentos
 * @property Collection|DiasNoHabile[] $dias_no_habiles
 * @property Collection|DietaPaciente[] $dieta_pacientes
 * @property Collection|Direccion[] $direccions
 * @property Collection|Documento[] $documentos
 * @property Collection|Empleador[] $empleadors
 * @property Collection|EntrenamientoPaciente[] $entrenamiento_pacientes
 * @property Collection|EstadoRud[] $estado_ruds
 * @property Collection|EstadoSolicitud[] $estado_solicituds
 * @property Collection|Estadopersona[] $estadopersonas
 * @property Collection|Estadosolicitudturno[] $estadosolicitudturnos
 * @property Collection|EstudioPrestacion[] $estudio_prestacions
 * @property Collection|Estudioexterno[] $estudioexternos
 * @property Collection|EstudioexternoLaboratorio[] $estudioexterno_laboratorios
 * @property Collection|Eventoauditable[] $eventoauditables
 * @property Collection|Eventohc[] $eventohcs
 * @property Collection|EvolucionDescripcion[] $evolucion_descripcions
 * @property Collection|Institucion[] $institucions
 * @property Collection|Familium[] $familia
 * @property Collection|Familiarelacion[] $familiarelacions
 * @property Collection|FarBloqueoAlmacen[] $far_bloqueo_almacens
 * @property Collection|FarCierreInventario[] $far_cierre_inventarios
 * @property Collection|FarCierreInventarioAlmacen[] $far_cierre_inventario_almacens
 * @property Collection|FarDetallePedidoAlmacen[] $far_detalle_pedido_almacens
 * @property Collection|FarEdicionEnvioSolicitud[] $far_edicion_envio_solicituds
 * @property Collection|FarEstadoHojaSolicitud[] $far_estado_hoja_solicituds
 * @property Collection|FarEstadoSolicitud[] $far_estado_solicituds
 * @property Collection|FarFrascoPlanHidratacion[] $far_frasco_plan_hidratacions
 * @property Collection|FarGoteo[] $far_goteos
 * @property Collection|FarHojaPedido[] $far_hoja_pedidos
 * @property Collection|FarHojaSolicitud[] $far_hoja_solicituds
 * @property Collection|FarOrigenPrograma[] $far_origen_programas
 * @property Collection|FarPedidoAlmacen[] $far_pedido_almacens
 * @property Collection|FarPlanHidratacion[] $far_plan_hidratacions
 * @property Collection|FarPrograma[] $far_programas
 * @property Collection|FarSolicitudMedicamento[] $far_solicitud_medicamentos
 * @property Collection|Fisioterapium[] $fisioterapia
 * @property Collection|GrupoSanguineo[] $grupo_sanguineos
 * @property Collection|HcAplicacionVacuna[] $hc_aplicacion_vacunas
 * @property Collection|HcAplicacionVacunaHc[] $hc_aplicacion_vacuna_hcs
 * @property Collection|HcInformacionAdicional[] $hc_informacion_adicionals
 * @property Collection|HcPerinatal[] $hc_perinatals
 * @property Collection|HcPerinatalDatosBasico[] $hc_perinatal_datos_basicos
 * @property Collection|HcPerinatalHc[] $hc_perinatal_hcs
 * @property Collection|HcTipoAplicacionVacuna[] $hc_tipo_aplicacion_vacunas
 * @property Collection|HcVacuna[] $hc_vacunas
 * @property Collection|HistoricoLogin[] $historico_logins
 * @property Collection|HojaConsumo[] $hoja_consumos
 * @property Collection|HookType[] $hook_types
 * @property Collection|Hook[] $hooks
 * @property Collection|Impresorafiscal[] $impresorafiscals
 * @property Collection|Impuesto[] $impuestos
 * @property Collection|Indicacion[] $indicacions
 * @property Collection|IndicacionEstetica[] $indicacion_esteticas
 * @property Collection|Informedeestudio[] $informedeestudios
 * @property Collection|InstitucionCategorium[] $institucion_categoria
 * @property Collection|InternacionCama[] $internacion_camas
 * @property Collection|InternacionConsistencium[] $internacion_consistencia
 * @property Collection|InternacionControlGlucemium[] $internacion_control_glucemia
 * @property Collection|InternacionCorreccionInsulinaCristalina[] $internacion_correccion_insulina_cristalinas
 * @property Collection|InternacionDetalleEstudiosInternacion[] $internacion_detalle_estudios_internacions
 * @property Collection|InternacionDiagnosticoPq[] $internacion_diagnostico_pqs
 * @property Collection|InternacionDietum[] $internacion_dieta
 * @property Collection|InternacionEnfermeriaEscalasValoracion[] $internacion_enfermeria_escalas_valoracions
 * @property Collection|InternacionEpicrisi[] $internacion_epicrisis
 * @property Collection|InternacionEstado[] $internacion_estados
 * @property Collection|InternacionEstadoOrden[] $internacion_estado_ordens
 * @property Collection|InternacionEstudioPq[] $internacion_estudio_pqs
 * @property Collection|InternacionEstudiosInternacion[] $internacion_estudios_internacions
 * @property Collection|InternacionEtiquetum[] $internacion_etiqueta
 * @property Collection|InternacionHabitacion[] $internacion_habitacions
 * @property Collection|InternacionHojaEnfermeriaConsumoDescartable[] $internacion_hoja_enfermeria_consumo_descartables
 * @property Collection|InternacionHojaEnfermeriaControle[] $internacion_hoja_enfermeria_controles
 * @property Collection|InternacionHojaEnfermeriaEgreso[] $internacion_hoja_enfermeria_egresos
 * @property Collection|InternacionHojaEnfermeriaIndicacion[] $internacion_hoja_enfermeria_indicacions
 * @property Collection|InternacionHojaEnfermeriaIngreso[] $internacion_hoja_enfermeria_ingresos
 * @property Collection|InternacionHojaEnfermeriaMedicacion[] $internacion_hoja_enfermeria_medicacions
 * @property Collection|InternacionHojaEnfermeriaNota[] $internacion_hoja_enfermeria_notas
 * @property Collection|InternacionHojaEnfermeriaPlane[] $internacion_hoja_enfermeria_planes
 * @property Collection|InternacionHojaEnfermeriaRiesgoCaida[] $internacion_hoja_enfermeria_riesgo_caidas
 * @property Collection|InternacionHojaEnfermeriaValoracionDolor[] $internacion_hoja_enfermeria_valoracion_dolors
 * @property Collection|InternacionHojaIndicacione[] $internacion_hoja_indicaciones
 * @property Collection|InternacionHojaIngreso[] $internacion_hoja_ingresos
 * @property Collection|InternacionHoraProgramada[] $internacion_hora_programadas
 * @property Collection|InternacionInterconsultum[] $internacion_interconsulta
 * @property Collection|InternacionInterconsultaComentario[] $internacion_interconsulta_comentarios
 * @property Collection|InternacionInterconsultaTipo[] $internacion_interconsulta_tipos
 * @property Collection|InternacionKinesioterapium[] $internacion_kinesioterapia
 * @property Collection|InternacionMotivoSuspension[] $internacion_motivo_suspensions
 * @property Collection|InternacionMotivocancelacionquirofano[] $internacion_motivocancelacionquirofanos
 * @property Collection|InternacionMovilidad[] $internacion_movilidads
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 * @property Collection|InternacionNivel[] $internacion_nivels
 * @property Collection|InternacionOrden[] $internacion_ordens
 * @property Collection|InternacionOrdenProgramada[] $internacion_orden_programadas
 * @property Collection|InternacionOxigenoterapium[] $internacion_oxigenoterapia
 * @property Collection|InternacionParteAnestesico[] $internacion_parte_anestesicos
 * @property Collection|InternacionPartePreanestesico[] $internacion_parte_preanestesicos
 * @property Collection|InternacionParteQuirurgico[] $internacion_parte_quirurgicos
 * @property Collection|InternacionPerfilEstudiosLabo[] $internacion_perfil_estudios_labos
 * @property Collection|InternacionPeriodicidadNebulizacione[] $internacion_periodicidad_nebulizaciones
 * @property Collection|InternacionPersona[] $internacion_personas
 * @property Collection|InternacionProcedimiento[] $internacion_procedimientos
 * @property Collection|InternacionProfilaxisTVP[] $internacion_profilaxis_t_v_ps
 * @property Collection|InternacionProteccionGastrica[] $internacion_proteccion_gastricas
 * @property Collection|InternacionQuirofano[] $internacion_quirofanos
 * @property Collection|InternacionQuirofanoAgenda[] $internacion_quirofano_agendas
 * @property Collection|InternacionQuirofanoAuditoriaEnfermerium[] $internacion_quirofano_auditoria_enfermeria
 * @property Collection|InternacionQuirofanoAuditoriaLimpieza[] $internacion_quirofano_auditoria_limpiezas
 * @property Collection|InternacionQuirofanoAuditoriaQuirofano[] $internacion_quirofano_auditoria_quirofanos
 * @property Collection|InternacionQuirofanoAuditoriaRecepcion[] $internacion_quirofano_auditoria_recepcions
 * @property Collection|InternacionQuirofanoAuditoriaRecuperacion[] $internacion_quirofano_auditoria_recuperacions
 * @property Collection|InternacionQuirofanoAuditoriaTimer[] $internacion_quirofano_auditoria_timers
 * @property Collection|InternacionQuirofanoBoxEnfermerium[] $internacion_quirofano_box_enfermeria
 * @property Collection|InternacionQuirofanoCamaDestino[] $internacion_quirofano_cama_destinos
 * @property Collection|InternacionQuirofanoCamaDestinoRecuperacion[] $internacion_quirofano_cama_destino_recuperacions
 * @property Collection|InternacionQuirofanoEquipo[] $internacion_quirofano_equipos
 * @property Collection|InternacionQuirofanoMotivoDemora[] $internacion_quirofano_motivo_demoras
 * @property Collection|InternacionQuirofanoMotivoDemoraQuirofano[] $internacion_quirofano_motivo_demora_quirofanos
 * @property Collection|InternacionQuirofanoTipoAnestesium[] $internacion_quirofano_tipo_anestesia
 * @property Collection|InternacionQuirofanoTipoCamaDestino[] $internacion_quirofano_tipo_cama_destinos
 * @property Collection|InternacionRecordAnestesico[] $internacion_record_anestesicos
 * @property Collection|InternacionRol[] $internacion_rols
 * @property Collection|InternacionSala[] $internacion_salas
 * @property Collection|InternacionSalaAlmacenesASolicitar[] $internacion_sala_almacenes_a_solicitars
 * @property Collection|InternacionServicio[] $internacion_servicios
 * @property Collection|InternacionTipoAltum[] $internacion_tipo_alta
 * @property Collection|InternacionTipoEgreso[] $internacion_tipo_egresos
 * @property Collection|InternacionTipoEvento[] $internacion_tipo_eventos
 * @property Collection|ItemArancelPrecio[] $item_arancel_precios
 * @property Collection|LineaFacturaImpuesto[] $linea_factura_impuestos
 * @property Collection|MarcaDeTarjeta[] $marca_de_tarjetas
 * @property Collection|MaterialPredominanteVivienda[] $material_predominante_viviendas
 * @property Collection|Medicion[] $medicions
 * @property Collection|MedicionesAntropometrica[] $mediciones_antropometricas
 * @property Collection|ModalidadContratacion[] $modalidad_contratacions
 * @property Collection|ModulosFacturacion[] $modulos_facturacions
 * @property Collection|Moneda[] $monedas
 * @property Collection|MotivoTurno[] $motivo_turnos
 * @property Collection|MovimientoCaja[] $movimiento_cajas
 * @property Collection|MovimientoConcepto[] $movimiento_conceptos
 * @property Collection|Objetivo[] $objetivos
 * @property Collection|ObservacionQuirofano[] $observacion_quirofanos
 * @property Collection|Odontoaplicacion[] $odontoaplicacions
 * @property Collection|Odontoimagen[] $odontoimagens
 * @property Collection|Odontopiezainvolucrada[] $odontopiezainvolucradas
 * @property Collection|Organigrama[] $organigramas
 * @property Collection|OrigenDemanda[] $origen_demandas
 * @property Collection|Origenplansocial[] $origenplansocials
 * @property Collection|PasswordResetToken[] $password_reset_tokens
 * @property Collection|PastoralAccion[] $pastoral_accions
 * @property Collection|PastoralAreaParticipante[] $pastoral_area_participantes
 * @property Collection|PastoralEtiquetum[] $pastoral_etiqueta
 * @property Collection|PastoralEvento[] $pastoral_eventos
 * @property Collection|PastoralEventoAdicional[] $pastoral_evento_adicionals
 * @property Collection|PastoralEventoParticipante[] $pastoral_evento_participantes
 * @property Collection|PastoralNecesidad[] $pastoral_necesidads
 * @property Collection|PastoralSacramento[] $pastoral_sacramentos
 * @property Collection|PastoralTipoevento[] $pastoral_tipoeventos
 * @property Collection|PastoralTipoparticipante[] $pastoral_tipoparticipantes
 * @property Collection|Perfil[] $perfils
 * @property Collection|PermisoAlmacenDistribuye[] $permiso_almacen_distribuyes
 * @property Collection|PermisoBloqueoEstudio[] $permiso_bloqueo_estudios
 * @property Collection|PermisoturnoEspecialidad[] $permisoturno_especialidads
 * @property Collection|Persona[] $personas
 * @property Collection|PersonaArchivo[] $persona_archivos
 * @property Collection|PersonaAuditorium[] $persona_auditoria
 * @property Collection|PersonaEducacion[] $persona_educacions
 * @property Collection|PersonaEmpleado[] $persona_empleados
 * @property Collection|PersonaPlan[] $persona_plans
 * @property Collection|PersonaPlanPorDefecto[] $persona_plan_por_defectos
 * @property Collection|PersonaPlansocial[] $persona_plansocials
 * @property Collection|PersonaTipoContribuyente[] $persona_tipo_contribuyentes
 * @property Collection|PersonaTrabajo[] $persona_trabajos
 * @property Collection|PersonaVivienda[] $persona_viviendas
 * @property Collection|Piso[] $pisos
 * @property Collection|PlanCantidadPrestacione[] $plan_cantidad_prestaciones
 * @property Collection|PlanDeBeneficio[] $plan_de_beneficios
 * @property Collection|Plansocial[] $plansocials
 * @property Collection|Prefactura[] $prefacturas
 * @property Collection|Preferenciahorariasolicitud[] $preferenciahorariasolicituds
 * @property Collection|PrestacionEnfermeriaPrestacion[] $prestacion_enfermeria_prestacions
 * @property Collection|Prestador[] $prestadors
 * @property Collection|PrestadorInstitucion[] $prestador_institucions
 * @property Collection|Presupuesto[] $presupuestos
 * @property Collection|ProfesionalDerivante[] $profesional_derivantes
 * @property Collection|ProfesionalPlan[] $profesional_plans
 * @property Collection|ProfesionalPlanArancel[] $profesional_plan_arancels
 * @property Collection|Proveedor[] $proveedors
 * @property Collection|RegistroCambioPrestacionConvenio[] $registro_cambio_prestacion_convenios
 * @property Collection|ReglaAgenda[] $regla_agendas
 * @property Collection|RelacionArticulotpPrestacion[] $relacion_articulotp_prestacions
 * @property Collection|Religion[] $religions
 * @property Collection|Reporte[] $reportes
 * @property Collection|Reporteconfig[] $reporteconfigs
 * @property Collection|ReservaQuirofano[] $reserva_quirofanos
 * @property Collection|RudDescripcion[] $rud_descripcions
 * @property Collection|RudMovimientosCertificacion[] $rud_movimientos_certificacions
 * @property Collection|RudRud[] $rud_ruds
 * @property Collection|RudSeguimientoObraPublica[] $rud_seguimiento_obra_publicas
 * @property Collection|ServicioPaciente[] $servicio_pacientes
 * @property Collection|SignoFisioterapium[] $signo_fisioterapia
 * @property Collection|Sited[] $siteds
 * @property Collection|Solicitudturno[] $solicitudturnos
 * @property Collection|Solicitudturnoprioridad[] $solicitudturnoprioridads
 * @property Collection|StkAlmacen[] $stk_almacens
 * @property Collection|StkArticuloalmacenminmax[] $stk_articuloalmacenminmaxes
 * @property Collection|StkCierreInventario[] $stk_cierre_inventarios
 * @property Collection|StkCierreInventarioAlmacen[] $stk_cierre_inventario_almacens
 * @property Collection|SubcategoriaObra[] $subcategoria_obras
 * @property Collection|SuministrosAutorizacione[] $suministros_autorizaciones
 * @property Collection|SuministrosCategorium[] $suministros_categoria
 * @property Collection|SuministrosCentroDeCosto[] $suministros_centro_de_costos
 * @property Collection|SuministrosCitum[] $suministros_cita
 * @property Collection|SuministrosCitaParticipante[] $suministros_cita_participantes
 * @property Collection|SuministrosComentariosOrden[] $suministros_comentarios_ordens
 * @property Collection|SuministrosComentariosPago[] $suministros_comentarios_pagos
 * @property Collection|SuministrosComentariosSolicitud[] $suministros_comentarios_solicituds
 * @property Collection|SuministrosConfiguracionUsuariosActa[] $suministros_configuracion_usuarios_actas
 * @property SuministrosConfiguracionUsuariosComisionRecepcion|null $suministros_configuracion_usuarios_comision_recepcion
 * @property Collection|SuministrosCronogramaDeEntrega[] $suministros_cronograma_de_entregas
 * @property Collection|SuministrosCuentum[] $suministros_cuenta
 * @property Collection|SuministrosCuentaDeGasto[] $suministros_cuenta_de_gastos
 * @property Collection|SuministrosCuentaDeIngreso[] $suministros_cuenta_de_ingresos
 * @property Collection|SuministrosDescarga[] $suministros_descargas
 * @property Collection|SuministrosGrupo[] $suministros_grupos
 * @property Collection|SuministrosNotificacion[] $suministros_notificacions
 * @property Collection|SuministrosOrdenDeCompra[] $suministros_orden_de_compras
 * @property Collection|SuministrosPagosCabecera[] $suministros_pagos_cabeceras
 * @property Collection|SuministrosPagosDetalle[] $suministros_pagos_detalles
 * @property Collection|SuministrosPersonalCargoProvisorio[] $suministros_personal_cargo_provisorios
 * @property Collection|SuministrosPresupuesto[] $suministros_presupuestos
 * @property Collection|SuministrosPrograma[] $suministros_programas
 * @property Collection|SuministrosProrrogaSolicitud[] $suministros_prorroga_solicituds
 * @property Collection|SuministrosProveedor[] $suministros_proveedors
 * @property Collection|SuministrosProveedorUsuario[] $suministros_proveedor_usuarios
 * @property Collection|SuministrosProyecto[] $suministros_proyectos
 * @property Collection|SuministrosRenglon[] $suministros_renglons
 * @property Collection|SuministrosRenglonSolicitud[] $suministros_renglon_solicituds
 * @property Collection|SuministrosRenglonVale[] $suministros_renglon_vales
 * @property Collection|SuministrosSolicitudDeCompra[] $suministros_solicitud_de_compras
 * @property Collection|SuministrosSubcuentaDeGasto[] $suministros_subcuenta_de_gastos
 * @property Collection|SuministrosSuministro[] $suministros_suministros
 * @property Collection|SuministrosTipoPedido[] $suministros_tipo_pedidos
 * @property Collection|SuministrosUnidadRequiriente[] $suministros_unidad_requirientes
 * @property Collection|SuministrosUnidadRequirienteUsuario[] $suministros_unidad_requiriente_usuarios
 * @property Collection|SuministrosVale[] $suministros_vales
 * @property Collection|Tarjetadepago[] $tarjetadepagos
 * @property Collection|TedefLotesFacturacion[] $tedef_lotes_facturacions
 * @property Collection|TedefOdontoBonoitem[] $tedef_odonto_bonoitems
 * @property Collection|TemplateEmail[] $template_emails
 * @property Collection|TemplateHojaEvolucion[] $template_hoja_evolucions
 * @property Collection|TemplateSm[] $template_sms
 * @property Collection|TestFisioterapium[] $test_fisioterapia
 * @property Collection|TipoArancelMedico[] $tipo_arancel_medicos
 * @property Collection|TipoArticulo[] $tipo_articulos
 * @property Collection|TipoEspecialidad[] $tipo_especialidads
 * @property Collection|TipoInstitucion[] $tipo_institucions
 * @property Collection|TipoMovimiento[] $tipo_movimientos
 * @property Collection|TipoPlan[] $tipo_plans
 * @property Collection|TipoRecaudoFactura[] $tipo_recaudo_facturas
 * @property Collection|TipoVivienda[] $tipo_viviendas
 * @property Collection|TipobonoTipoprestacion[] $tipobono_tipoprestacions
 * @property Collection|Tipotarjetadepago[] $tipotarjetadepagos
 * @property Collection|Tipounidadmedida[] $tipounidadmedidas
 * @property Collection|TokenSiat[] $token_siats
 * @property Collection|TratamientoImpositivo[] $tratamiento_impositivos
 * @property Collection|TurnoProgramado[] $turno_programados
 * @property Collection|UbicacionAlmacen[] $ubicacion_almacens
 * @property Collection|UnidadNegocio[] $unidad_negocios
 * @property Collection|UserNotification[] $user_notifications
 * @property Collection|UsuarioAlmacen[] $usuario_almacens
 * @property UsuarioConfig|null $usuario_config
 * @property Collection|UsuarioPortal[] $usuario_portals
 *
 * @package App\Models
 */
class Usuario extends Model
{
	use SoftDeletes;
	protected $table = 'usuario';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'personal_id' => 'int',
		'borrado_logico' => 'bool',
		'last_login' => 'datetime',
		'log_attempt' => 'int',
		'blocked_account' => 'bool',
		'cambiar_password' => 'bool'
	];

	protected $hidden = [
		'password',
		'cambiar_password'
	];

	protected $fillable = [
		'username',
		'password',
		'created_by',
		'modified_by',
		'deleted_by',
		'personal_id',
		'borrado_logico',
		'last_login',
		'log_attempt',
		'blocked_account',
		'codigo_ad_hoc',
		'cambiar_password'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function extension_vigencia_siteds()
	{
		return $this->hasMany(ExtensionVigenciaSited::class, 'creadopor_id');
	}

	public function admin_ambito_hechos()
	{
		return $this->hasMany(AdminAmbitoHecho::class, 'modificado_por_id');
	}

	public function admin_ambito_hecho_privados()
	{
		return $this->hasMany(AdminAmbitoHechoPrivado::class, 'modificado_por_id');
	}

	public function admin_configuracion_temporals()
	{
		return $this->hasMany(AdminConfiguracionTemporal::class, 'modificado_por_id');
	}

	public function admin_criterio_comparacions()
	{
		return $this->hasMany(AdminCriterioComparacion::class, 'modificado_por_id');
	}

	public function admin_estudios_laboratorios()
	{
		return $this->hasMany(AdminEstudiosLaboratorio::class, 'borrado_por_id');
	}

	public function admin_gestions()
	{
		return $this->hasMany(AdminGestion::class, 'modificado_por_id');
	}

	public function admin_grupo_de_riesgos()
	{
		return $this->hasMany(AdminGrupoDeRiesgo::class, 'borrado_por_id');
	}

	public function admin_metodo_anticonceptivos()
	{
		return $this->hasMany(AdminMetodoAnticonceptivo::class, 'modificado_por_id');
	}

	public function admin_noticia()
	{
		return $this->hasMany(AdminNoticium::class, 'modificado_por_id');
	}

	public function admin_origen_atencions()
	{
		return $this->hasMany(AdminOrigenAtencion::class, 'modificado_por_id');
	}

	public function permisos()
	{
		return $this->belongsToMany(Permiso::class, 'admin_permiso_usuario', 'modificado_por_id')
					->withPivot('id', 'usuario_id', 'creado_por_id');
	}

	public function admin_pruebas_laboratorios()
	{
		return $this->hasMany(AdminPruebasLaboratorio::class, 'borrado_por_id');
	}

	public function admin_sector_laboratorios()
	{
		return $this->hasMany(AdminSectorLaboratorio::class, 'modificado_por_id');
	}

	public function admin_tipo_periodos()
	{
		return $this->hasMany(AdminTipoPeriodo::class, 'modificado_por_id');
	}

	public function admin_tratamiento_hormonals()
	{
		return $this->hasMany(AdminTratamientoHormonal::class, 'modificado_por_id');
	}

	public function admin_turno_enfermeria()
	{
		return $this->hasMany(AdminTurnoEnfermerium::class, 'modificado_por_id');
	}

	public function admin_ws_api_usuario_pacientes()
	{
		return $this->hasMany(AdminWsApiUsuarioPaciente::class, 'usuario_ws_id');
	}

	public function admision_asignacionauditoria()
	{
		return $this->hasMany(AdmisionAsignacionauditorium::class, 'created_by');
	}

	public function agencia_financia()
	{
		return $this->hasMany(AgenciaFinancium::class, 'modificado_por_id');
	}

	public function agua_extraedesde_viviendas()
	{
		return $this->hasMany(AguaExtraedesdeVivienda::class, 'eliminado_por_id');
	}

	public function agua_provienedesde_viviendas()
	{
		return $this->hasMany(AguaProvienedesdeVivienda::class, 'eliminado_por_id');
	}

	public function almacens()
	{
		return $this->hasMany(Almacen::class, 'modificado_por_id');
	}

	public function antecedente_n_opatologicos()
	{
		return $this->hasMany(AntecedenteNOpatologico::class, 'eliminadopor_id');
	}

	public function antecedentehabitonocivos()
	{
		return $this->hasMany(Antecedentehabitonocivo::class, 'creadopor_id');
	}

	public function antecedenteheredofamiliars()
	{
		return $this->hasMany(Antecedenteheredofamiliar::class, 'eliminadopor_id');
	}

	public function antecedentenutricionalpediatricos()
	{
		return $this->hasMany(Antecedentenutricionalpediatrico::class, 'eliminadopor_id');
	}

	public function antecedentepatologicos()
	{
		return $this->hasMany(Antecedentepatologico::class, 'eliminadopor_id');
	}

	public function antecedenteperinatals()
	{
		return $this->hasMany(Antecedenteperinatal::class, 'eliminadopor_id');
	}

	public function antecedentequirurgicos()
	{
		return $this->hasMany(Antecedentequirurgico::class, 'eliminadopor_id');
	}

	public function arancel_medicos()
	{
		return $this->hasMany(ArancelMedico::class, 'created_by');
	}

	public function archivos()
	{
		return $this->hasMany(Archivo::class, 'eliminadopor_id');
	}

	public function area_privadas()
	{
		return $this->hasMany(AreaPrivada::class, 'eliminadopor_id');
	}

	public function area_servicios()
	{
		return $this->hasMany(AreaServicio::class, 'created_by');
	}

	public function articulos()
	{
		return $this->hasMany(Articulo::class, 'eliminado_por_id');
	}

	public function articulo_tipopresentacions()
	{
		return $this->hasMany(ArticuloTipopresentacion::class, 'eliminado_por_id');
	}

	public function articuloalmacenminmaxes()
	{
		return $this->hasMany(Articuloalmacenminmax::class, 'eliminado_por_id');
	}

	public function articulocronicos()
	{
		return $this->hasMany(Articulocronico::class, 'eliminado_por_id');
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'eliminado_por_id');
	}

	public function articulotp_prestacions()
	{
		return $this->hasMany(ArticulotpPrestacion::class, 'creadopor_id');
	}

	public function auditoria_reserva_quirofanos()
	{
		return $this->hasMany(AuditoriaReservaQuirofano::class, 'created_by');
	}

	public function auditoria_videoconsulta()
	{
		return $this->hasMany(AuditoriaVideoconsultum::class);
	}

	public function auditoriadiagnosticos()
	{
		return $this->hasMany(Auditoriadiagnostico::class, 'borradopor_id');
	}

	public function automatic_hooks()
	{
		return $this->hasMany(AutomaticHook::class, 'created_by');
	}

	public function autorizaciones_aprobacions()
	{
		return $this->hasMany(AutorizacionesAprobacion::class, 'created_by');
	}

	public function autorizaciones_auditoria_estados()
	{
		return $this->hasMany(AutorizacionesAuditoriaEstado::class, 'created_by');
	}

	public function autorizaciones_autorizacion_archivos()
	{
		return $this->hasMany(AutorizacionesAutorizacionArchivo::class, 'created_by');
	}

	public function autorizaciones_diagnosticos()
	{
		return $this->hasMany(AutorizacionesDiagnostico::class, 'created_by');
	}

	public function autorizaciones_estados()
	{
		return $this->hasMany(AutorizacionesEstado::class, 'created_by');
	}

	public function autorizaciones_medicacions()
	{
		return $this->hasMany(AutorizacionesMedicacion::class, 'created_by');
	}

	public function autorizaciones_notas()
	{
		return $this->hasMany(AutorizacionesNota::class, 'created_by');
	}

	public function autorizaciones_notas_auditor_facturacions()
	{
		return $this->hasMany(AutorizacionesNotasAuditorFacturacion::class, 'created_by');
	}

	public function autorizaciones_notas_practicas()
	{
		return $this->hasMany(AutorizacionesNotasPractica::class, 'created_by');
	}

	public function autorizaciones_plan_atp_tipocoberturas()
	{
		return $this->hasMany(AutorizacionesPlanAtpTipocobertura::class, 'created_by');
	}

	public function autorizaciones_practicas()
	{
		return $this->hasMany(AutorizacionesPractica::class, 'created_by');
	}

	public function autorizaciones_reintegros()
	{
		return $this->hasMany(AutorizacionesReintegro::class, 'created_by');
	}

	public function autorizaciones_reintegro_estudios()
	{
		return $this->hasMany(AutorizacionesReintegroEstudio::class, 'created_by');
	}

	public function autorizaciones_reintegro_medicamentos()
	{
		return $this->hasMany(AutorizacionesReintegroMedicamento::class, 'created_by');
	}

	public function autorizaciones_tipo_coberturas()
	{
		return $this->hasMany(AutorizacionesTipoCobertura::class, 'created_by');
	}

	public function autorizaciones_tipo_prestacions()
	{
		return $this->hasMany(AutorizacionesTipoPrestacion::class, 'created_by');
	}

	public function bancos()
	{
		return $this->hasMany(Banco::class, 'modificado_por_id');
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class, 'modificadopor_id');
	}

	public function broker_configs()
	{
		return $this->hasMany(BrokerConfig::class, 'created_by');
	}

	public function cajas()
	{
		return $this->hasMany(Caja::class, 'created_by');
	}

	public function calefaccion_ycocina_viviendas()
	{
		return $this->hasMany(CalefaccionYcocinaVivienda::class, 'eliminado_por_id');
	}

	public function cambio_estado_turnos()
	{
		return $this->hasMany(CambioEstadoTurno::class, 'modified_by');
	}

	public function cancelacion_origens()
	{
		return $this->hasMany(CancelacionOrigen::class, 'creado_por_id');
	}

	public function capituloodontologia()
	{
		return $this->hasMany(Capituloodontologium::class, 'borradopor_id');
	}

	public function capituloodontologia_estudios()
	{
		return $this->hasMany(CapituloodontologiaEstudio::class, 'borradopor_id');
	}

	public function categoria_obras()
	{
		return $this->hasMany(CategoriaObra::class, 'borrado_por_id');
	}

	public function categoria_subcategoria()
	{
		return $this->hasMany(CategoriaSubcategorium::class, 'modificado_por_id');
	}

	public function categoriaobrasocials()
	{
		return $this->hasMany(Categoriaobrasocial::class, 'eliminadopor_id');
	}

	public function causa_bloqueos()
	{
		return $this->hasMany(CausaBloqueo::class, 'modificado_por_id');
	}

	public function causa_hc_pasivas()
	{
		return $this->hasMany(CausaHcPasiva::class, 'borradopor_id');
	}

	public function centrodecostos()
	{
		return $this->hasMany(Centrodecosto::class, 'eliminadopor_id');
	}

	public function concepto_compensatorios()
	{
		return $this->hasMany(ConceptoCompensatorio::class, 'created_by');
	}

	public function condicion_ivas()
	{
		return $this->hasMany(CondicionIva::class, 'created_by');
	}

	public function condicion_tenencia_viviendas()
	{
		return $this->hasMany(CondicionTenenciaVivienda::class, 'eliminado_por_id');
	}

	public function configs()
	{
		return $this->hasMany(Config::class, 'borradopor_id');
	}

	public function configuracion_cuotas()
	{
		return $this->hasMany(ConfiguracionCuota::class, 'created_by');
	}

	public function consentimiento_informado_configs()
	{
		return $this->hasMany(ConsentimientoInformadoConfig::class, 'modifiedBy_id');
	}

	public function consulta_medicion_ginecologia()
	{
		return $this->hasMany(ConsultaMedicionGinecologium::class, 'modificado_por_id');
	}

	public function consultadetalles()
	{
		return $this->hasMany(Consultadetalle::class, 'borradopor_id');
	}

	public function convenio_prestadors()
	{
		return $this->hasMany(ConvenioPrestador::class, 'created_by');
	}

	public function conversions()
	{
		return $this->hasMany(Conversion::class, 'created_by');
	}

	public function cotizacion_aranceles_precios()
	{
		return $this->hasMany(CotizacionArancelesPrecio::class, 'created_by');
	}

	public function criterios_de_reprogramacions()
	{
		return $this->hasMany(CriteriosDeReprogramacion::class, 'creado_por_id');
	}

	public function debitos_y_creditos()
	{
		return $this->hasMany(DebitosYCredito::class, 'created_by');
	}

	public function declaracion_etiquetas()
	{
		return $this->hasMany(DeclaracionEtiqueta::class, 'created_by');
	}

	public function dependencia_sub_categoria()
	{
		return $this->hasMany(DependenciaSubCategorium::class, 'modificado_por_id');
	}

	public function derivacions()
	{
		return $this->hasMany(Derivacion::class, 'created_by');
	}

	public function desague_viviendas()
	{
		return $this->hasMany(DesagueVivienda::class, 'eliminado_por_id');
	}

	public function descuentos()
	{
		return $this->hasMany(Descuento::class, 'creadopor_id');
	}

	public function dias_no_habiles()
	{
		return $this->hasMany(DiasNoHabile::class, 'eliminado_por_id');
	}

	public function dieta_pacientes()
	{
		return $this->hasMany(DietaPaciente::class, 'created_by');
	}

	public function direccions()
	{
		return $this->hasMany(Direccion::class, 'modified_by');
	}

	public function documentos()
	{
		return $this->hasMany(Documento::class, 'modificadopor_id');
	}

	public function empleadors()
	{
		return $this->hasMany(Empleador::class, 'created_by');
	}

	public function entrenamiento_pacientes()
	{
		return $this->hasMany(EntrenamientoPaciente::class, 'created_by');
	}

	public function estado_ruds()
	{
		return $this->hasMany(EstadoRud::class, 'modificado_por_id');
	}

	public function estado_solicituds()
	{
		return $this->hasMany(EstadoSolicitud::class, 'eliminado_por_id');
	}

	public function estadopersonas()
	{
		return $this->hasMany(Estadopersona::class, 'eliminado_por_id');
	}

	public function estadosolicitudturnos()
	{
		return $this->hasMany(Estadosolicitudturno::class, 'eliminado_por_id');
	}

	public function estudio_prestacions()
	{
		return $this->hasMany(EstudioPrestacion::class, 'eliminadopor_id');
	}

	public function estudioexternos()
	{
		return $this->hasMany(Estudioexterno::class, 'eliminado_por_id');
	}

	public function estudioexterno_laboratorios()
	{
		return $this->hasMany(EstudioexternoLaboratorio::class, 'created_by');
	}

	public function eventoauditables()
	{
		return $this->hasMany(Eventoauditable::class, 'borradopor_id');
	}

	public function eventohcs()
	{
		return $this->hasMany(Eventohc::class, 'modificadopor_id');
	}

	public function evolucion_descripcions()
	{
		return $this->hasMany(EvolucionDescripcion::class, 'creado_por_id');
	}

	public function institucions()
	{
		return $this->belongsToMany(Institucion::class, 'fac_usuario_institucion', 'eliminado_por_id')
					->withPivot('id', 'usuario_id', 'creado_por_id', 'modificado_por_id', 'creado_en', 'modificado_en', 'borrado_en', 'borrado_logico');
	}

	public function familia()
	{
		return $this->hasMany(Familium::class, 'eliminado_por_id');
	}

	public function familiarelacions()
	{
		return $this->hasMany(Familiarelacion::class, 'eliminado_por_id');
	}

	public function far_bloqueo_almacens()
	{
		return $this->hasMany(FarBloqueoAlmacen::class, 'created_by');
	}

	public function far_cierre_inventarios()
	{
		return $this->hasMany(FarCierreInventario::class, 'modificado_por_id');
	}

	public function far_cierre_inventario_almacens()
	{
		return $this->hasMany(FarCierreInventarioAlmacen::class, 'modificado_por_id');
	}

	public function far_detalle_pedido_almacens()
	{
		return $this->hasMany(FarDetallePedidoAlmacen::class, 'cancelado_por');
	}

	public function far_edicion_envio_solicituds()
	{
		return $this->hasMany(FarEdicionEnvioSolicitud::class, 'creado_por_id');
	}

	public function far_estado_hoja_solicituds()
	{
		return $this->hasMany(FarEstadoHojaSolicitud::class, 'modificado_por_id');
	}

	public function far_estado_solicituds()
	{
		return $this->hasMany(FarEstadoSolicitud::class, 'modificado_por_id');
	}

	public function far_frasco_plan_hidratacions()
	{
		return $this->hasMany(FarFrascoPlanHidratacion::class, 'modificado_por_id');
	}

	public function far_goteos()
	{
		return $this->hasMany(FarGoteo::class, 'eliminado_por_id');
	}

	public function far_hoja_pedidos()
	{
		return $this->hasMany(FarHojaPedido::class, 'modificado_por_id');
	}

	public function far_hoja_solicituds()
	{
		return $this->hasMany(FarHojaSolicitud::class, 'modificado_por_id');
	}

	public function far_origen_programas()
	{
		return $this->hasMany(FarOrigenPrograma::class, 'modificado_por_id');
	}

	public function far_pedido_almacens()
	{
		return $this->hasMany(FarPedidoAlmacen::class, 'modificado_por_id');
	}

	public function far_plan_hidratacions()
	{
		return $this->hasMany(FarPlanHidratacion::class, 'modificado_por_id');
	}

	public function far_programas()
	{
		return $this->hasMany(FarPrograma::class, 'modificado_por_id');
	}

	public function far_solicitud_medicamentos()
	{
		return $this->hasMany(FarSolicitudMedicamento::class, 'modificado_por_id');
	}

	public function fisioterapia()
	{
		return $this->hasMany(Fisioterapium::class, 'created_by');
	}

	public function grupo_sanguineos()
	{
		return $this->hasMany(GrupoSanguineo::class, 'borradopor_id');
	}

	public function hc_aplicacion_vacunas()
	{
		return $this->hasMany(HcAplicacionVacuna::class, 'modificado_por_id');
	}

	public function hc_aplicacion_vacuna_hcs()
	{
		return $this->hasMany(HcAplicacionVacunaHc::class, 'modificado_por_id');
	}

	public function hc_informacion_adicionals()
	{
		return $this->hasMany(HcInformacionAdicional::class, 'eliminadopor_id');
	}

	public function hc_perinatals()
	{
		return $this->hasMany(HcPerinatal::class, 'modificado_por_id');
	}

	public function hc_perinatal_datos_basicos()
	{
		return $this->hasMany(HcPerinatalDatosBasico::class, 'modificado_por_id');
	}

	public function hc_perinatal_hcs()
	{
		return $this->hasMany(HcPerinatalHc::class, 'modificado_por_id');
	}

	public function hc_tipo_aplicacion_vacunas()
	{
		return $this->hasMany(HcTipoAplicacionVacuna::class, 'modificado_por_id');
	}

	public function hc_vacunas()
	{
		return $this->hasMany(HcVacuna::class, 'modificado_por_id');
	}

	public function historico_logins()
	{
		return $this->hasMany(HistoricoLogin::class);
	}

	public function hoja_consumos()
	{
		return $this->hasMany(HojaConsumo::class, 'borradopor_id');
	}

	public function hook_types()
	{
		return $this->hasMany(HookType::class, 'created_by');
	}

	public function hooks()
	{
		return $this->hasMany(Hook::class, 'created_by');
	}

	public function impresorafiscals()
	{
		return $this->hasMany(Impresorafiscal::class, 'created_by');
	}

	public function impuestos()
	{
		return $this->hasMany(Impuesto::class, 'created_by');
	}

	public function indicacions()
	{
		return $this->hasMany(Indicacion::class, 'created_by');
	}

	public function indicacion_esteticas()
	{
		return $this->hasMany(IndicacionEstetica::class, 'created_by');
	}

	public function informedeestudios()
	{
		return $this->hasMany(Informedeestudio::class, 'informadopor_id');
	}

	public function institucion_categoria()
	{
		return $this->hasMany(InstitucionCategorium::class, 'modificado_por_id');
	}

	public function internacion_camas()
	{
		return $this->hasMany(InternacionCama::class, 'borrado_por_id');
	}

	public function internacion_consistencia()
	{
		return $this->hasMany(InternacionConsistencium::class, 'borradopor_id');
	}

	public function internacion_control_glucemia()
	{
		return $this->hasMany(InternacionControlGlucemium::class, 'borradopor_id');
	}

	public function internacion_correccion_insulina_cristalinas()
	{
		return $this->hasMany(InternacionCorreccionInsulinaCristalina::class, 'borradopor_id');
	}

	public function internacion_detalle_estudios_internacions()
	{
		return $this->hasMany(InternacionDetalleEstudiosInternacion::class, 'borrado_por_id');
	}

	public function internacion_diagnostico_pqs()
	{
		return $this->hasMany(InternacionDiagnosticoPq::class, 'creado_por_id');
	}

	public function internacion_dieta()
	{
		return $this->hasMany(InternacionDietum::class, 'borradopor_id');
	}

	public function internacion_enfermeria_escalas_valoracions()
	{
		return $this->hasMany(InternacionEnfermeriaEscalasValoracion::class, 'responsable_id');
	}

	public function internacion_epicrisis()
	{
		return $this->hasMany(InternacionEpicrisi::class, 'borrado_por_id');
	}

	public function internacion_estados()
	{
		return $this->hasMany(InternacionEstado::class, 'borrado_por_id');
	}

	public function internacion_estado_ordens()
	{
		return $this->hasMany(InternacionEstadoOrden::class, 'borrado_por_id');
	}

	public function internacion_estudio_pqs()
	{
		return $this->hasMany(InternacionEstudioPq::class, 'creado_por_id');
	}

	public function internacion_estudios_internacions()
	{
		return $this->hasMany(InternacionEstudiosInternacion::class, 'borrado_por_id');
	}

	public function internacion_etiqueta()
	{
		return $this->hasMany(InternacionEtiquetum::class, 'borrado_por_id');
	}

	public function internacion_habitacions()
	{
		return $this->hasMany(InternacionHabitacion::class, 'borrado_por_id');
	}

	public function internacion_hoja_enfermeria_consumo_descartables()
	{
		return $this->hasMany(InternacionHojaEnfermeriaConsumoDescartable::class, 'created_by');
	}

	public function internacion_hoja_enfermeria_controles()
	{
		return $this->hasMany(InternacionHojaEnfermeriaControle::class, 'creado_por_id');
	}

	public function internacion_hoja_enfermeria_egresos()
	{
		return $this->hasMany(InternacionHojaEnfermeriaEgreso::class, 'creado_por_id');
	}

	public function internacion_hoja_enfermeria_indicacions()
	{
		return $this->hasMany(InternacionHojaEnfermeriaIndicacion::class, 'modificado_por_id');
	}

	public function internacion_hoja_enfermeria_ingresos()
	{
		return $this->hasMany(InternacionHojaEnfermeriaIngreso::class, 'creado_por_id');
	}

	public function internacion_hoja_enfermeria_medicacions()
	{
		return $this->hasMany(InternacionHojaEnfermeriaMedicacion::class, 'modificado_por_id');
	}

	public function internacion_hoja_enfermeria_notas()
	{
		return $this->hasMany(InternacionHojaEnfermeriaNota::class, 'modificado_por_id');
	}

	public function internacion_hoja_enfermeria_planes()
	{
		return $this->hasMany(InternacionHojaEnfermeriaPlane::class, 'modificado_por_id');
	}

	public function internacion_hoja_enfermeria_riesgo_caidas()
	{
		return $this->hasMany(InternacionHojaEnfermeriaRiesgoCaida::class, 'creado_por_id');
	}

	public function internacion_hoja_enfermeria_valoracion_dolors()
	{
		return $this->hasMany(InternacionHojaEnfermeriaValoracionDolor::class, 'creado_por_id');
	}

	public function internacion_hoja_indicaciones()
	{
		return $this->hasMany(InternacionHojaIndicacione::class, 'borrado_por_id');
	}

	public function internacion_hoja_ingresos()
	{
		return $this->hasMany(InternacionHojaIngreso::class, 'creado_por_id');
	}

	public function internacion_hora_programadas()
	{
		return $this->hasMany(InternacionHoraProgramada::class, 'borrado_por_id');
	}

	public function internacion_interconsulta()
	{
		return $this->hasMany(InternacionInterconsultum::class, 'creadopor_id');
	}

	public function internacion_interconsulta_comentarios()
	{
		return $this->hasMany(InternacionInterconsultaComentario::class, 'creadopor_id');
	}

	public function internacion_interconsulta_tipos()
	{
		return $this->hasMany(InternacionInterconsultaTipo::class, 'creadopor_id');
	}

	public function internacion_kinesioterapia()
	{
		return $this->hasMany(InternacionKinesioterapium::class, 'borradopor_id');
	}

	public function internacion_motivo_suspensions()
	{
		return $this->hasMany(InternacionMotivoSuspension::class, 'borrado_por_id');
	}

	public function internacion_motivocancelacionquirofanos()
	{
		return $this->hasMany(InternacionMotivocancelacionquirofano::class, 'created_by');
	}

	public function internacion_movilidads()
	{
		return $this->hasMany(InternacionMovilidad::class, 'borradopor_id');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'borrado_por_id');
	}

	public function internacion_nivels()
	{
		return $this->hasMany(InternacionNivel::class, 'borrado_por_id');
	}

	public function internacion_ordens()
	{
		return $this->hasMany(InternacionOrden::class, 'borrado_por_id');
	}

	public function internacion_orden_programadas()
	{
		return $this->hasMany(InternacionOrdenProgramada::class, 'recepcionado_por');
	}

	public function internacion_oxigenoterapia()
	{
		return $this->hasMany(InternacionOxigenoterapium::class, 'borradopor_id');
	}

	public function internacion_parte_anestesicos()
	{
		return $this->hasMany(InternacionParteAnestesico::class, 'creado_por_id');
	}

	public function internacion_parte_preanestesicos()
	{
		return $this->hasMany(InternacionPartePreanestesico::class, 'creado_por_id');
	}

	public function internacion_parte_quirurgicos()
	{
		return $this->hasMany(InternacionParteQuirurgico::class, 'modificado_por_id');
	}

	public function internacion_perfil_estudios_labos()
	{
		return $this->hasMany(InternacionPerfilEstudiosLabo::class, 'borrado_por_id');
	}

	public function internacion_periodicidad_nebulizaciones()
	{
		return $this->hasMany(InternacionPeriodicidadNebulizacione::class, 'borradopor_id');
	}

	public function internacion_personas()
	{
		return $this->hasMany(InternacionPersona::class, 'borrado_por_id');
	}

	public function internacion_procedimientos()
	{
		return $this->hasMany(InternacionProcedimiento::class, 'borrado_por_id');
	}

	public function internacion_profilaxis_t_v_ps()
	{
		return $this->hasMany(InternacionProfilaxisTVP::class, 'borradopor_id');
	}

	public function internacion_proteccion_gastricas()
	{
		return $this->hasMany(InternacionProteccionGastrica::class, 'borradopor_id');
	}

	public function internacion_quirofanos()
	{
		return $this->hasMany(InternacionQuirofano::class, 'created_by');
	}

	public function internacion_quirofano_agendas()
	{
		return $this->hasMany(InternacionQuirofanoAgenda::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_enfermeria()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaEnfermerium::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_limpiezas()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaLimpieza::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_quirofanos()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaQuirofano::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_recepcions()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaRecepcion::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_recuperacions()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaRecuperacion::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_timers()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaTimer::class);
	}

	public function internacion_quirofano_box_enfermeria()
	{
		return $this->hasMany(InternacionQuirofanoBoxEnfermerium::class, 'created_by');
	}

	public function internacion_quirofano_cama_destinos()
	{
		return $this->hasMany(InternacionQuirofanoCamaDestino::class, 'created_by');
	}

	public function internacion_quirofano_cama_destino_recuperacions()
	{
		return $this->hasMany(InternacionQuirofanoCamaDestinoRecuperacion::class, 'created_by');
	}

	public function internacion_quirofano_equipos()
	{
		return $this->hasMany(InternacionQuirofanoEquipo::class, 'created_by');
	}

	public function internacion_quirofano_motivo_demoras()
	{
		return $this->hasMany(InternacionQuirofanoMotivoDemora::class, 'created_by');
	}

	public function internacion_quirofano_motivo_demora_quirofanos()
	{
		return $this->hasMany(InternacionQuirofanoMotivoDemoraQuirofano::class, 'created_by');
	}

	public function internacion_quirofano_tipo_anestesia()
	{
		return $this->hasMany(InternacionQuirofanoTipoAnestesium::class, 'created_by');
	}

	public function internacion_quirofano_tipo_cama_destinos()
	{
		return $this->hasMany(InternacionQuirofanoTipoCamaDestino::class, 'created_by');
	}

	public function internacion_record_anestesicos()
	{
		return $this->hasMany(InternacionRecordAnestesico::class, 'creadopor_id');
	}

	public function internacion_rols()
	{
		return $this->hasMany(InternacionRol::class, 'borrado_por_id');
	}

	public function internacion_salas()
	{
		return $this->hasMany(InternacionSala::class, 'borrado_por_id');
	}

	public function internacion_sala_almacenes_a_solicitars()
	{
		return $this->hasMany(InternacionSalaAlmacenesASolicitar::class, 'created_by');
	}

	public function internacion_servicios()
	{
		return $this->hasMany(InternacionServicio::class, 'borrado_por_id');
	}

	public function internacion_tipo_alta()
	{
		return $this->hasMany(InternacionTipoAltum::class, 'created_by');
	}

	public function internacion_tipo_egresos()
	{
		return $this->hasMany(InternacionTipoEgreso::class, 'borrado_por_id');
	}

	public function internacion_tipo_eventos()
	{
		return $this->hasMany(InternacionTipoEvento::class, 'borrado_por_id');
	}

	public function item_arancel_precios()
	{
		return $this->hasMany(ItemArancelPrecio::class, 'created_by');
	}

	public function linea_factura_impuestos()
	{
		return $this->hasMany(LineaFacturaImpuesto::class, 'created_by');
	}

	public function marca_de_tarjetas()
	{
		return $this->hasMany(MarcaDeTarjeta::class, 'created_by');
	}

	public function material_predominante_viviendas()
	{
		return $this->hasMany(MaterialPredominanteVivienda::class, 'eliminado_por_id');
	}

	public function medicions()
	{
		return $this->hasMany(Medicion::class, 'borradopor_id');
	}

	public function mediciones_antropometricas()
	{
		return $this->hasMany(MedicionesAntropometrica::class, 'created_by');
	}

	public function modalidad_contratacions()
	{
		return $this->hasMany(ModalidadContratacion::class, 'creado_por_id');
	}

	public function modulos_facturacions()
	{
		return $this->hasMany(ModulosFacturacion::class, 'modifiedBy');
	}

	public function monedas()
	{
		return $this->hasMany(Moneda::class, 'created_by');
	}

	public function motivo_turnos()
	{
		return $this->hasMany(MotivoTurno::class, 'created_by');
	}

	public function movimiento_cajas()
	{
		return $this->hasMany(MovimientoCaja::class, 'created_by');
	}

	public function movimiento_conceptos()
	{
		return $this->hasMany(MovimientoConcepto::class, 'created_by');
	}

	public function objetivos()
	{
		return $this->hasMany(Objetivo::class, 'created_by');
	}

	public function observacion_quirofanos()
	{
		return $this->hasMany(ObservacionQuirofano::class, 'creadopor_id');
	}

	public function odontoaplicacions()
	{
		return $this->hasMany(Odontoaplicacion::class, 'creadopor_id');
	}

	public function odontoimagens()
	{
		return $this->hasMany(Odontoimagen::class, 'borradopor_id');
	}

	public function odontopiezainvolucradas()
	{
		return $this->hasMany(Odontopiezainvolucrada::class, 'borradopor_id');
	}

	public function organigramas()
	{
		return $this->hasMany(Organigrama::class, 'modificado_por_id');
	}

	public function origen_demandas()
	{
		return $this->hasMany(OrigenDemanda::class, 'modificado_por_id');
	}

	public function origenplansocials()
	{
		return $this->hasMany(Origenplansocial::class, 'eliminado_por_id');
	}

	public function password_reset_tokens()
	{
		return $this->hasMany(PasswordResetToken::class, 'user_id');
	}

	public function pastoral_accions()
	{
		return $this->hasMany(PastoralAccion::class, 'creadopor_id');
	}

	public function pastoral_area_participantes()
	{
		return $this->hasMany(PastoralAreaParticipante::class, 'creadopor_id');
	}

	public function pastoral_etiqueta()
	{
		return $this->hasMany(PastoralEtiquetum::class, 'creadopor_id');
	}

	public function pastoral_eventos()
	{
		return $this->hasMany(PastoralEvento::class, 'creadopor_id');
	}

	public function pastoral_evento_adicionals()
	{
		return $this->hasMany(PastoralEventoAdicional::class, 'creadopor_id');
	}

	public function pastoral_evento_participantes()
	{
		return $this->hasMany(PastoralEventoParticipante::class, 'creadopor_id');
	}

	public function pastoral_necesidads()
	{
		return $this->hasMany(PastoralNecesidad::class, 'creadopor_id');
	}

	public function pastoral_sacramentos()
	{
		return $this->hasMany(PastoralSacramento::class, 'creadopor_id');
	}

	public function pastoral_tipoeventos()
	{
		return $this->hasMany(PastoralTipoevento::class, 'creadopor_id');
	}

	public function pastoral_tipoparticipantes()
	{
		return $this->hasMany(PastoralTipoparticipante::class, 'creadopor_id');
	}

	public function perfils()
	{
		return $this->belongsToMany(Perfil::class);
	}

	public function permiso_almacen_distribuyes()
	{
		return $this->hasMany(PermisoAlmacenDistribuye::class);
	}

	public function permiso_bloqueo_estudios()
	{
		return $this->hasMany(PermisoBloqueoEstudio::class, 'creadopor_id');
	}

	public function permisoturno_especialidads()
	{
		return $this->hasMany(PermisoturnoEspecialidad::class, 'borradopor_id');
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'persona_usuario_portal', 'created_by')
					->withPivot('id', 'modified_by', 'usuario_portal_id', 'principal', 'provisorio', 'type', 'borrado_logico', 'modified_at');
	}

	public function persona_archivos()
	{
		return $this->hasMany(PersonaArchivo::class, 'eliminado_por_id');
	}

	public function persona_auditoria()
	{
		return $this->hasMany(PersonaAuditorium::class, 'borradopor_id');
	}

	public function persona_educacions()
	{
		return $this->hasMany(PersonaEducacion::class, 'eliminado_por_id');
	}

	public function persona_empleados()
	{
		return $this->hasMany(PersonaEmpleado::class, 'created_by');
	}

	public function persona_plans()
	{
		return $this->hasMany(PersonaPlan::class, 'created_by');
	}

	public function persona_plan_por_defectos()
	{
		return $this->hasMany(PersonaPlanPorDefecto::class, 'created_by');
	}

	public function persona_plansocials()
	{
		return $this->hasMany(PersonaPlansocial::class, 'eliminado_por_id');
	}

	public function persona_tipo_contribuyentes()
	{
		return $this->hasMany(PersonaTipoContribuyente::class, 'created_by');
	}

	public function persona_trabajos()
	{
		return $this->hasMany(PersonaTrabajo::class, 'eliminado_por_id');
	}

	public function persona_viviendas()
	{
		return $this->hasMany(PersonaVivienda::class, 'modificado_por_id');
	}

	public function pisos()
	{
		return $this->hasMany(Piso::class, 'created_by');
	}

	public function plan_cantidad_prestaciones()
	{
		return $this->hasMany(PlanCantidadPrestacione::class, 'created_by');
	}

	public function plan_de_beneficios()
	{
		return $this->hasMany(PlanDeBeneficio::class, 'creado_por_id');
	}

	public function plansocials()
	{
		return $this->hasMany(Plansocial::class, 'eliminado_por_id');
	}

	public function prefacturas()
	{
		return $this->hasMany(Prefactura::class, 'modificadopor_id');
	}

	public function preferenciahorariasolicituds()
	{
		return $this->hasMany(Preferenciahorariasolicitud::class, 'eliminado_por_id');
	}

	public function prestacion_enfermeria_prestacions()
	{
		return $this->hasMany(PrestacionEnfermeriaPrestacion::class, 'eliminadopor_id');
	}

	public function prestadors()
	{
		return $this->hasMany(Prestador::class, 'created_by');
	}

	public function prestador_institucions()
	{
		return $this->hasMany(PrestadorInstitucion::class, 'created_by');
	}

	public function presupuestos()
	{
		return $this->hasMany(Presupuesto::class, 'created_by');
	}

	public function profesional_derivantes()
	{
		return $this->hasMany(ProfesionalDerivante::class, 'created_by');
	}

	public function profesional_plans()
	{
		return $this->hasMany(ProfesionalPlan::class, 'created_by');
	}

	public function profesional_plan_arancels()
	{
		return $this->hasMany(ProfesionalPlanArancel::class, 'created_by');
	}

	public function proveedors()
	{
		return $this->hasMany(Proveedor::class, 'eliminado_por_id');
	}

	public function registro_cambio_prestacion_convenios()
	{
		return $this->hasMany(RegistroCambioPrestacionConvenio::class, 'createdBy');
	}

	public function regla_agendas()
	{
		return $this->hasMany(ReglaAgenda::class, 'created_by');
	}

	public function relacion_articulotp_prestacions()
	{
		return $this->hasMany(RelacionArticulotpPrestacion::class, 'creadopor_id');
	}

	public function religions()
	{
		return $this->hasMany(Religion::class, 'created_by');
	}

	public function reportes()
	{
		return $this->hasMany(Reporte::class, 'modificadopor_id');
	}

	public function reporteconfigs()
	{
		return $this->hasMany(Reporteconfig::class, 'modificadopor_id');
	}

	public function reserva_quirofanos()
	{
		return $this->hasMany(ReservaQuirofano::class, 'created_by');
	}

	public function rud_descripcions()
	{
		return $this->hasMany(RudDescripcion::class, 'modificado_por_id');
	}

	public function rud_movimientos_certificacions()
	{
		return $this->hasMany(RudMovimientosCertificacion::class, 'borrado_por_id');
	}

	public function rud_ruds()
	{
		return $this->hasMany(RudRud::class, 'modificado_por_id');
	}

	public function rud_seguimiento_obra_publicas()
	{
		return $this->hasMany(RudSeguimientoObraPublica::class, 'borrado_por_id');
	}

	public function servicio_pacientes()
	{
		return $this->hasMany(ServicioPaciente::class, 'created_by');
	}

	public function signo_fisioterapia()
	{
		return $this->hasMany(SignoFisioterapium::class, 'created_by');
	}

	public function siteds()
	{
		return $this->hasMany(Sited::class, 'creadopor_id');
	}

	public function solicitudturnos()
	{
		return $this->hasMany(Solicitudturno::class, 'usuario_cancela_id');
	}

	public function solicitudturnoprioridads()
	{
		return $this->hasMany(Solicitudturnoprioridad::class, 'eliminado_por_id');
	}

	public function stk_almacens()
	{
		return $this->hasMany(StkAlmacen::class, 'modificado_por_id');
	}

	public function stk_articuloalmacenminmaxes()
	{
		return $this->hasMany(StkArticuloalmacenminmax::class, 'eliminado_por_id');
	}

	public function stk_cierre_inventarios()
	{
		return $this->hasMany(StkCierreInventario::class, 'modificado_por_id');
	}

	public function stk_cierre_inventario_almacens()
	{
		return $this->hasMany(StkCierreInventarioAlmacen::class, 'modificado_por_id');
	}

	public function subcategoria_obras()
	{
		return $this->hasMany(SubcategoriaObra::class, 'borrado_por_id');
	}

	public function suministros_autorizaciones()
	{
		return $this->hasMany(SuministrosAutorizacione::class, 'eliminado_por_id');
	}

	public function suministros_categoria()
	{
		return $this->hasMany(SuministrosCategorium::class, 'eliminadopor_id');
	}

	public function suministros_centro_de_costos()
	{
		return $this->hasMany(SuministrosCentroDeCosto::class, 'borradopor_id');
	}

	public function suministros_cita()
	{
		return $this->hasMany(SuministrosCitum::class, 'eliminadopor_id');
	}

	public function suministros_cita_participantes()
	{
		return $this->hasMany(SuministrosCitaParticipante::class, 'eliminadopor_id');
	}

	public function suministros_comentarios_ordens()
	{
		return $this->hasMany(SuministrosComentariosOrden::class, 'eliminadopor_id');
	}

	public function suministros_comentarios_pagos()
	{
		return $this->hasMany(SuministrosComentariosPago::class, 'eliminadopor_id');
	}

	public function suministros_comentarios_solicituds()
	{
		return $this->hasMany(SuministrosComentariosSolicitud::class, 'eliminadopor_id');
	}

	public function suministros_configuracion_usuarios_actas()
	{
		return $this->hasMany(SuministrosConfiguracionUsuariosActa::class);
	}

	public function suministros_configuracion_usuarios_comision_recepcion()
	{
		return $this->hasOne(SuministrosConfiguracionUsuariosComisionRecepcion::class);
	}

	public function suministros_cronograma_de_entregas()
	{
		return $this->hasMany(SuministrosCronogramaDeEntrega::class, 'eliminadopor_id');
	}

	public function suministros_cuenta()
	{
		return $this->hasMany(SuministrosCuentum::class, 'borradopor_id');
	}

	public function suministros_cuenta_de_gastos()
	{
		return $this->hasMany(SuministrosCuentaDeGasto::class, 'borradopor_id');
	}

	public function suministros_cuenta_de_ingresos()
	{
		return $this->hasMany(SuministrosCuentaDeIngreso::class, 'borradopor_id');
	}

	public function suministros_descargas()
	{
		return $this->hasMany(SuministrosDescarga::class, 'eliminadopor_id');
	}

	public function suministros_grupos()
	{
		return $this->hasMany(SuministrosGrupo::class, 'borradopor_id');
	}

	public function suministros_notificacions()
	{
		return $this->hasMany(SuministrosNotificacion::class, 'eliminadopor_id');
	}

	public function suministros_orden_de_compras()
	{
		return $this->hasMany(SuministrosOrdenDeCompra::class, 'responsable_id');
	}

	public function suministros_pagos_cabeceras()
	{
		return $this->hasMany(SuministrosPagosCabecera::class, 'eliminadopor_id');
	}

	public function suministros_pagos_detalles()
	{
		return $this->hasMany(SuministrosPagosDetalle::class, 'eliminadopor_id');
	}

	public function suministros_personal_cargo_provisorios()
	{
		return $this->hasMany(SuministrosPersonalCargoProvisorio::class, 'borradopor_id');
	}

	public function suministros_presupuestos()
	{
		return $this->hasMany(SuministrosPresupuesto::class, 'eliminado_por_id');
	}

	public function suministros_programas()
	{
		return $this->hasMany(SuministrosPrograma::class, 'borradopor_id');
	}

	public function suministros_prorroga_solicituds()
	{
		return $this->hasMany(SuministrosProrrogaSolicitud::class, 'eliminadopor_id');
	}

	public function suministros_proveedors()
	{
		return $this->hasMany(SuministrosProveedor::class, 'eliminadopor_id');
	}

	public function suministros_proveedor_usuarios()
	{
		return $this->hasMany(SuministrosProveedorUsuario::class);
	}

	public function suministros_proyectos()
	{
		return $this->hasMany(SuministrosProyecto::class, 'borradopor_id');
	}

	public function suministros_renglons()
	{
		return $this->hasMany(SuministrosRenglon::class, 'entregadopor_id');
	}

	public function suministros_renglon_solicituds()
	{
		return $this->hasMany(SuministrosRenglonSolicitud::class, 'eliminadopor_id');
	}

	public function suministros_renglon_vales()
	{
		return $this->hasMany(SuministrosRenglonVale::class, 'anuladopor_id');
	}

	public function suministros_solicitud_de_compras()
	{
		return $this->hasMany(SuministrosSolicitudDeCompra::class, 'creadopor_id');
	}

	public function suministros_subcuenta_de_gastos()
	{
		return $this->hasMany(SuministrosSubcuentaDeGasto::class, 'borradopor_id');
	}

	public function suministros_suministros()
	{
		return $this->hasMany(SuministrosSuministro::class, 'eliminadopor_id');
	}

	public function suministros_tipo_pedidos()
	{
		return $this->hasMany(SuministrosTipoPedido::class, 'modificado_por_id');
	}

	public function suministros_unidad_requirientes()
	{
		return $this->hasMany(SuministrosUnidadRequiriente::class, 'eliminadopor_id');
	}

	public function suministros_unidad_requiriente_usuarios()
	{
		return $this->hasMany(SuministrosUnidadRequirienteUsuario::class);
	}

	public function suministros_vales()
	{
		return $this->hasMany(SuministrosVale::class, 'autorizadopor_id');
	}

	public function tarjetadepagos()
	{
		return $this->hasMany(Tarjetadepago::class, 'modificado_por_id');
	}

	public function tedef_lotes_facturacions()
	{
		return $this->hasMany(TedefLotesFacturacion::class, 'created_by');
	}

	public function tedef_odonto_bonoitems()
	{
		return $this->hasMany(TedefOdontoBonoitem::class, 'creado_por_id');
	}

	public function template_emails()
	{
		return $this->hasMany(TemplateEmail::class, 'created_by');
	}

	public function template_hoja_evolucions()
	{
		return $this->hasMany(TemplateHojaEvolucion::class, 'modifiedBy');
	}

	public function template_sms()
	{
		return $this->hasMany(TemplateSm::class, 'created_by');
	}

	public function test_fisioterapia()
	{
		return $this->hasMany(TestFisioterapium::class, 'created_by');
	}

	public function tipo_arancel_medicos()
	{
		return $this->hasMany(TipoArancelMedico::class, 'created_by');
	}

	public function tipo_articulos()
	{
		return $this->hasMany(TipoArticulo::class, 'creado_por_id');
	}

	public function tipo_especialidads()
	{
		return $this->hasMany(TipoEspecialidad::class, 'modificado_por_id');
	}

	public function tipo_institucions()
	{
		return $this->hasMany(TipoInstitucion::class, 'created_by');
	}

	public function tipo_movimientos()
	{
		return $this->hasMany(TipoMovimiento::class, 'created_by');
	}

	public function tipo_plans()
	{
		return $this->hasMany(TipoPlan::class, 'created_by');
	}

	public function tipo_recaudo_facturas()
	{
		return $this->hasMany(TipoRecaudoFactura::class, 'creado_por_id');
	}

	public function tipo_viviendas()
	{
		return $this->hasMany(TipoVivienda::class, 'eliminado_por_id');
	}

	public function tipobono_tipoprestacions()
	{
		return $this->hasMany(TipobonoTipoprestacion::class, 'eliminadopor_id');
	}

	public function tipotarjetadepagos()
	{
		return $this->hasMany(Tipotarjetadepago::class, 'modificado_por_id');
	}

	public function tipounidadmedidas()
	{
		return $this->hasMany(Tipounidadmedida::class, 'modificado_por_id');
	}

	public function token_siats()
	{
		return $this->hasMany(TokenSiat::class, 'created_by');
	}

	public function tratamiento_impositivos()
	{
		return $this->hasMany(TratamientoImpositivo::class, 'created_by');
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class, 'usuarioultimollamado_id');
	}

	public function ubicacion_almacens()
	{
		return $this->hasMany(UbicacionAlmacen::class, 'modificadoPor');
	}

	public function unidad_negocios()
	{
		return $this->hasMany(UnidadNegocio::class, 'creadopor_id');
	}

	public function user_notifications()
	{
		return $this->hasMany(UserNotification::class);
	}

	public function usuario_almacens()
	{
		return $this->hasMany(UsuarioAlmacen::class, 'eliminado_por_id');
	}

	public function usuario_config()
	{
		return $this->hasOne(UsuarioConfig::class);
	}

	public function usuario_portals()
	{
		return $this->hasMany(UsuarioPortal::class, 'created_by');
	}
}
