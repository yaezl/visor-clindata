/**
 * Sidebar de ClinData:
 * - Desktop (>= 992px): botón "toggle" colapsa/expande el ancho del sidebar.
 * - Mobile (< 992px): el sidebar se comporta como off-canvas (se abre/cierra
 *   con un botón hamburguesa en el topbar) usando la clase .cd-sidebar-mobile-open.
 */
document.addEventListener('DOMContentLoaded', () => {
    const appShell = document.querySelector('.cd-app-shell');
    const collapseBtn = document.querySelector('[data-cd-sidebar-toggle]');
    const mobileOpenBtn = document.querySelector('[data-cd-sidebar-mobile-toggle]');
    const backdrop = document.querySelector('[data-cd-sidebar-backdrop]');

    if (!appShell) return;

    const isDesktop = () => window.matchMedia('(min-width: 992px)').matches;

    // Toggle de colapsado en desktop
    if (collapseBtn) {
        collapseBtn.addEventListener('click', () => {
            if (isDesktop()) {
                appShell.classList.toggle('is-sidebar-collapsed');
            } else {
                appShell.classList.remove('cd-sidebar-mobile-open');
            }
        });
    }

    // Apertura off-canvas en mobile
    if (mobileOpenBtn) {
        mobileOpenBtn.addEventListener('click', () => {
            appShell.classList.add('cd-sidebar-mobile-open');
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', () => {
            appShell.classList.remove('cd-sidebar-mobile-open');
        });
    }

    // Si el usuario redimensiona la ventana y pasa a desktop, limpiamos el estado mobile
    window.addEventListener('resize', () => {
        if (isDesktop()) {
            appShell.classList.remove('cd-sidebar-mobile-open');
        }
    });
});