# ClinData — Visor de Historia Clínica Pediátrica

> Demo funcional con datos de prueba cargados. 

ClinData es una capa de lectura sobre bases clínicas hospitalarias. Se conecta al esquema **Alephoo** y presenta, por paciente, una vista clínica coherente pensada para profesionales de la salud con distintos niveles de familiaridad con sistemas.

No reemplaza el sistema de gestión hospitalaria: lee sus datos y los reorganiza en una interfaz orientada a la consulta clínica, no a la administración.

---

## ¿Qué resuelve?

Los HIS (Hospital Information Systems) almacenan información clínica dispersa en tablas diseñadas para facturación, turnos y stock. ClinData agrega esa información por paciente y la presenta en cuatro secciones:

- **Resumen** — diagnósticos frecuentes, detección de patrones de consultas recurrentes por categoría clínica, última consulta y medicación activa. Todo calculado con queries directas sobre los datos existentes, sin IA.
- **Antecedentes** — antecedentes patológicos, perinatales y quirúrgicos del paciente.
- **Vacunación** — esquema de vacunas aplicadas y pendientes según el calendario.
- **Crecimiento** — mediciones antropométricas (peso, talla, perímetro cefálico) graficadas contra percentiles OMS.

---

## Stack técnico

| Capa | Tecnología |
|---|---|
| Backend | Laravel 12 · PHP 8.2+ |
| Frontend | Blade · Bootstrap 5 · Bootstrap Icons · Sass |
| Interactividad | Alpine.js (acordeones, paneles lazy) |
| Gráficos | Chart.js (curvas de crecimiento, estadísticas del dashboard) |
| Build | Vite |
| Base de datos | SQLite (demo) · MySQL (producción conectada a Alephoo) |

---

## Estructura del proyecto

```
app/
├── Http/Controllers/     # Un controller por entidad clínica
│                         # (Persona, Consulta, Diagnostico, Eventohc,
│                         #  HcVacuna, InformedeEstudio, Dashboard, etc.)
├── Models/               # ~400 modelos Eloquent mapeando el esquema Alephoo
└── Services/             # Lógica de agregación de datos por dominio:
                          #  PatientSummaryService, VacunacionService,
                          #  CrecimientoService, AntecedenteService, etc.

resources/
├── views/patients/       # Listado, detalle (header + 4 acordeones)
│                         # e historia clínica cronológica
├── views/dashboard/      # Turnos del día + calendario mensual
└── css/                  # Estilos por sección + variables de marca

database/
├── migrations/           # Solo tablas propias (alergia, medicacion, etc.)
│                         # El esquema Alephoo no se migra desde acá
└── seeders/              # Casos clínicos pediátricos coherentes:
                          # 12 pacientes ficticios con síntomas, diagnósticos,
                          # crecimiento, vacunas y turnos acordes entre sí.
                          # Percentiles OMS incluidos.
```

---

## Rutas principales

| Ruta | Descripción |
|---|---|
| `/` | Redirige al login |
| `/dashboard` | Turnos del día + estadísticas |
| `/calendar` | Vista de calendario mensual |
| `/patients` | Buscador y listado de pacientes |
| `/patients/{id}` | Historia clínica cronológica del paciente |
| `/patients/{id}/detail` | Vista de detalle: header + 4 acordeones (carga lazy) |
| `/patients/{id}/panel/resumen` | Panel de resumen clínico (AJAX) |
| `/patients/{id}/panel/antecedentes` | Panel de antecedentes (AJAX) |
| `/patients/{id}/panel/vacunacion` | Panel de vacunación (AJAX) |
| `/patients/{id}/panel/crecimiento` | Panel de crecimiento (AJAX) |

Todas las rutas de datos clínicos están protegidas por el middleware `auth`.

---

## Datos de demo

El entorno de demo incluye **12 pacientes pediátricos ficticios** con historias clínicas completas y coherentes entre sí:

- Consultas, diagnósticos y evoluciones
- Antecedentes patológicos, perinatales y quirúrgicos
- Esquema de vacunación con aplicaciones registradas
- Mediciones antropométricas para graficar curvas de crecimiento
- Alergias y medicación activa
- Turnos programados en el calendario

Los datos fueron generados con seeders propios (`database/seeders/`) y no provienen de pacientes reales.

**Usuario de acceso a la demo:**
```
Email:     demo@clindata.dev
Contraseña: password
```

---

## Instalación local

**Requisitos:** PHP 8.2+, Composer, Node.js 18+, npm.

```bash
# 1. Clonar y entrar al directorio
git clone <repo-url>
cd visor-clindata-demo

# 2. Setup completo (instala dependencias, genera clave, migra y compila)
composer run setup

# 3. Cargar los datos de demo
php artisan db:seed

# 4. Levantar el servidor de desarrollo
composer run dev
```

La app queda disponible en `http://localhost:8000`.

> El setup usa **SQLite** por defecto (no requiere servidor de base de datos). Para conectar a un MySQL existente, editar las variables `DB_*` en `.env`.

---

## Variables de entorno relevantes

```env
APP_NAME=ClinData
APP_ENV=local          # Cambiar a 'production' al deployar
APP_KEY=               # Se genera con artisan key:generate
APP_DEBUG=true         # Poner en false en producción
APP_URL=http://localhost

DB_CONNECTION=sqlite   # Cambiar a 'mysql' para conectar a Alephoo
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=nombre_de_la_base
# DB_USERNAME=usuario
# DB_PASSWORD=contraseña
```

---

## Colaboradores

<!-- Reemplazá los datos de cada colaborador con los reales -->

| Colaborador | Email | LinkedIn | GitHub |
|---|---|---|---|
| Jazmín Aliaga | jazminaliaga.itu@gmail.com | [linkedin.com/in/jazmin-aliaga](https://www.linkedin.com/in/jazmin-aliaga/) | [@jazminaliaga](https://github.com/jazminaliaga) |
| Florencia Adaro | flor.adaro@gmail.com | [linkedin.com/in/floradaro](https://www.linkedin.com/in/floradaro/) | [@adaroflorencia](https://github.com/adaroflorencia) |
| Paula Distefano | paudistefano03@gmail.com | [linkedin.com/in/paula-distefano](https://www.linkedin.com/in/paula-distefano/) | [@pauladist](https://github.com/pauladist) |
| Lucía Salvi | laysalvi@gmail.com | [linkedin.com/in/lucia-yasmin-salvi](https://www.linkedin.com/in/lucia-yasmin-salvi/) | [@lusalvi](https://github.com/lusalvi) |
| Yael Zuna | yaelzuna@gmail.com | [linkedin.com/in/yael-zuna](https://www.linkedin.com/in/yael-zuna/) | [@yaezl](https://github.com/yaezl) |

---

## Estado del proyecto

> **Demo funcional** — presentación académica / profesional.
> El proyecto es una prueba de concepto. No está conectado a datos reales de pacientes.
