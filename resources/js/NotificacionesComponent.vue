<template>
    <div class="notificaciones-container">
        <!-- Botón/Icono de notificaciones -->
        <div class="dropdown">
            <button class="btn btn-notificacion position-relative" @click="toggleDropdown">
                <i class="fas fa-bell"></i>
                <span v-if="contador > 0" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ contador }}
                </span>
            </button>

            <!-- Dropdown de notificaciones -->
            <div v-if="dropdownAbierto" class="dropdown-menu show notificaciones-dropdown">
                <div class="dropdown-header d-flex justify-content-between align-items-center">
                    <strong>Notificaciones</strong>
                    <div>
                        <button v-if="notificaciones.length > 0" 
                                @click="marcarTodasLeidas" 
                                class="btn btn-sm btn-outline-secondary">
                            Marcar todas como leídas
                        </button>
                    </div>
                </div>

                <div class="notificaciones-list">
                    <div v-if="cargando" class="text-center p-3">
                        <div class="spinner-border spinner-border-sm" role="status"></div>
                    </div>
                    
                    <div v-else-if="notificaciones.length === 0" class="text-center p-3 text-muted">
                        No hay notificaciones
                    </div>

                    <div v-else>
                        <div v-for="notificacion in notificaciones" 
                             :key="notificacion.id"
                             :class="['notificacion-item', { 'no-leida': !notificacion.leida }]"
                             @click="abrirNotificacion(notificacion)">
                            
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="notificacion-content">
                                    <h6 class="mb-1">{{ notificacion.titulo }}</h6>
                                    <p class="mb-1">{{ notificacion.mensaje }}</p>
                                    <small class="text-muted">{{ formatFecha(notificacion.created_at) }}</small>
                                </div>
                                
                                <div class="notificacion-actions">
                                    <button v-if="!notificacion.leida" 
                                            @click.stop="marcarLeida(notificacion)"
                                            class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button @click.stop="eliminarNotificacion(notificacion)"
                                            class="btn btn-sm btn-outline-danger ms-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown-footer text-center">
                    <a href="/notificaciones" class="btn btn-link">Ver todas las notificaciones</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'NotificacionesComponent',
    data() {
        return {
            dropdownAbierto: false,
            notificaciones: [],
            contador: 0,
            cargando: false,
            intervalo: null
        }
    },
    mounted() {
        this.cargarNotificaciones();
        this.cargarContador();
        
        // Actualizar cada 30 segundos
        this.intervalo = setInterval(() => {
            this.cargarContador();
        }, 30000);
        
        // Cerrar dropdown al hacer click fuera
        document.addEventListener('click', this.cerrarDropdown);
    },
    beforeUnmount() {
        if (this.intervalo) {
            clearInterval(this.intervalo);
        }
        document.removeEventListener('click', this.cerrarDropdown);
    },
    methods: {
        async cargarNotificaciones() {
            this.cargando = true;
            try {
                const response = await axios.get('/api/notificaciones');
                this.notificaciones = response.data.notificaciones.data || response.data.notificaciones;
            } catch (error) {
                console.error('Error cargando notificaciones:', error);
            } finally {
                this.cargando = false;
            }
        },
        
        async cargarContador() {
            try {
                const response = await axios.get('/api/notificaciones/contador');
                this.contador = response.data.contador;
            } catch (error) {
                console.error('Error cargando contador:', error);
            }
        },
        
        async marcarLeida(notificacion) {
            try {
                await axios.post(`/api/notificaciones/${notificacion.id}/leida`);
                notificacion.leida = true;
                this.contador = Math.max(0, this.contador - 1);
            } catch (error) {
                console.error('Error marcando notificación como leída:', error);
            }
        },
        
        async marcarTodasLeidas() {
            try {
                await axios.post('/api/notificaciones/marcar-todas-leidas');
                this.notificaciones.forEach(n => n.leida = true);
                this.contador = 0;
            } catch (error) {
                console.error('Error marcando todas como leídas:', error);
            }
        },
        
        async eliminarNotificacion(notificacion) {
            if (!confirm('¿Eliminar esta notificación?')) return;
            
            try {
                await axios.delete(`/api/notificaciones/${notificacion.id}`);
                this.notificaciones = this.notificaciones.filter(n => n.id !== notificacion.id);
                if (!notificacion.leida) {
                    this.contador = Math.max(0, this.contador - 1);
                }
            } catch (error) {
                console.error('Error eliminando notificación:', error);
            }
        },
        
        abrirNotificacion(notificacion) {
            if (!notificacion.leida) {
                this.marcarLeida(notificacion);
            }
            
            // Navegar a la acción de la notificación
            if (notificacion.data && notificacion.data.action_url) {
                window.location.href = notificacion.data.action_url;
            }
            
            this.dropdownAbierto = false;
        },
        
        toggleDropdown(event) {
            event.stopPropagation();
            this.dropdownAbierto = !this.dropdownAbierto;
            if (this.dropdownAbierto) {
                this.cargarNotificaciones();
            }
        },
        
        cerrarDropdown(event) {
            if (!this.$el.contains(event.target)) {
                this.dropdownAbierto = false;
            }
        },
        
        formatFecha(fecha) {
            return new Date(fecha).toLocaleDateString('es-ES', {
                day: 'numeric',
                month: 'short',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    }
}
</script>

<style scoped>
.btn-notificacion {
    background: none;
    border: none;
    font-size: 1.2rem;
    color: #6c757d;
    position: relative;
}

.btn-notificacion:hover {
    color: #495057;
}

.notificaciones-dropdown {
    width: 400px;
    max-height: 500px;
    overflow-y: auto;
    right: 0;
    left: auto !important;
}

.notificacion-item {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background-color 0.2s;
}

.notificacion-item:hover {
    background-color: #f8f9fa;
}

.notificacion-item.no-leida {
    background-color: #e8f4fd;
    border-left: 3px solid #007bff;
}

.notificacion-content {
    flex: 1;
    margin-right: 10px;
}

.notificacion-actions {
    opacity: 0;
    transition: opacity 0.2s;
}

.notificacion-item:hover .notificacion-actions {
    opacity: 1;
}

.dropdown-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.dropdown-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 10px;
}

.badge {
    font-size: 0.7rem;
}
</style>