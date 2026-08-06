# ClinData — Visor Inteligente de Historiales Médicos

ClinData es un visor de historia clínica pensado para el área de pediatría. Se conecta como capa de lectura sobre una base clínica hospitalaria existente (**Alephoo**) y presenta la información del paciente — antecedentes, diagnósticos, vacunación, crecimiento, medicación y alergias — en una interfaz simple, pensada para que un profesional de la salud (incluso con poca familiaridad con sistemas) encuentre lo que necesita en pocos clics.

## ¿Qué resuelve?

Los sistemas hospitalarios de gestión suelen tener la información clínica dispersa en decenas de tablas pensadas para facturación, turnos, stock, etc. ClinData no reemplaza ese sistema: lee sus datos y arma, por paciente, una vista clínica coherente:

- **Resumen**: diagnósticos frecuentes, detección de patrones de consultas recurrentes por categoría clínica, última consulta y medicación activa — todo calculado con queries directas sobre los datos ya cargados (sin IA).
- **Antecedentes**: patológicios y perinatales del paciente.
- **Vacunación**: esquema de vacunas y aplicaciones registradas.
- **Crecimiento**: mediciones antropométricas contra percentiles OMS.

## Stack técnico

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade + Bootstrap 5 + Bootstrap Icons + Sass, con Alpine.js para interactividad puntual
- **Gráficos**: Chart.js (curvas de crecimiento, estadísticas del dashboard)
- **Build**: Vite
- **Base de datos**: MySQL — se conecta a **Alephoo**, la base clínica compartida del hospital. La mayoría de los modelos (`app/Models`) mapean tablas ya existentes de ese esquema.

## Estructura del proyecto

```
app/
├── Http/Controllers/     # Un controller por entidad clínica (Persona, Consulta,
│                         # Diagnostico, Eventohc, HcVacuna, InformedeEstudio, etc.)
├── Models/               # ~400 modelos Eloquent mapeando el esquema de Alephoo
│                     
├── Services/             # Lógica de negocio y agregación de datos por dominio:
│                         # PatientSummaryService, VacunacionService,
│                         # CrecimientoService, AntecedenteService, etc.
resources/
├── views/patients/       # Listado, detalle (header + tabs) e historia clínica
├── views/dashboard/      # Turnos del día + calendario mensual
├── css/                  # Estilos por sección (patient-detail, vacunacion,
│                         # crecimiento, dashboard, etc.) + variables de marca
database/
├── migrations/         
│                         # el esquema pertenece a Alephoo y no se migra
├── seeders/              # Seeders coherentes para desarrollo: casos clínicos
│                         # pediátricos completos (síntomas + diagnóstico +
│                         # crecimiento acordes entre sí), catálogo de
│                         # diagnósticos, percentiles OMS, etc.
```

## Instalación

## Rutas principales

| Ruta | Descripción |
|---|---|
| `/dashboard` | Turnos del día y estadísticas |
| `/calendar` | Vista de calendario mensual |
| `/patients` | Buscador y listado de pacientes |
| `/patients/{id}` | Historia clínica cronológica del paciente |
| `/patients/{id}/detail` | Detalle del paciente: header + 4 acordeones (Resumen, Antecedentes, Vacunación, Crecimiento) |

Todas las rutas de datos clínicos están protegidas por el middleware `auth`.

## Diseño de la vista de paciente

La vista de detalle del paciente (`patients/detail`) fue diseñada pensando en profesionales con distintos niveles de familiaridad con sistemas: información clínica agrupada en 4 acordeones grandes y claros (Resumen, Antecedentes, Vacunación, Crecimiento), datos relevantes al paciente como campos principales y la opcion de visualizar historial medico completo.


## Estado del proyecto

> Proyecto en desarrollo activo.
