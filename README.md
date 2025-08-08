# YanlDev Ecommerce 🛒

Un sistema completo de comercio electrónico desarrollado con Laravel 12, Livewire 3 y Jetstream. Incluye panel administrativo completo, gestión de productos con variantes, sistema de categorización jerárquica y autenticación robusta.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=flat-square&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3.x-blue?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![Tailwind](https://img.shields.io/badge/Tailwind-3.4-38B2AC?style=flat-square&logo=tailwind-css)

## 🚀 Características Principales

### Frontend
- **Interfaz moderna** con Tailwind CSS y componentes interactivos
- **Navegación inteligente** con menú lateral dinámico
- **Sistema de filtros avanzado** por categorías, familias y características
- **Búsqueda en tiempo real** con Livewire
- **Slider de portadas** con gestión desde admin
- **Diseño responsive** optimizado para móviles

### Panel Administrativo
- **Dashboard completo** con métricas y estadísticas
- **Gestión de productos** con imágenes y variantes
- **Sistema de categorización jerárquica**: Familias → Categorías → Subcategorías
- **Gestión de opciones y características** (tallas, colores, etc.)
- **Editor de portadas** con orden arrastrando
- **Sistema de roles y permisos** con Jetstream

### Arquitectura Técnica
- **Livewire 3** para interactividad sin JavaScript complejo
- **Jetstream** para autenticación y gestión de equipos
- **Fortify** para funcionalidades de autenticación
- **Factory & Seeders** con datos de ejemplo realistas
- **Componentes reutilizables** bien estructurados
- **Validación robusta** en frontend y backend

## 📋 Requisitos del Sistema

- **PHP**: 8.2 o superior
- **Composer**: 2.x
- **Node.js**: 18.x o superior
- **MySQL**: 8.0 o superior / MariaDB 10.3+
- **Extensiones PHP**: PDO, Mbstring, OpenSSL, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo, GD

## ⚡ Instalación Rápida

### 1. Clonar el repositorio
```bash
git clone https://github.com/YanlDev/yanlecommerce.git
cd yanlecommerce
```

### 2. Instalar dependencias
```bash
# Dependencias PHP
composer install

# Dependencias JavaScript
npm install
```

### 3. Configurar entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Crear enlace simbólico para almacenamiento
php artisan storage:link
```

### 4. Configurar base de datos
Edita el archivo `.env` con tus credenciales:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yanlecommerce
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 5. Migrar y poblar la base de datos
```bash
# Ejecutar migraciones y seeders
php artisan migrate:fresh --seed
```

### 6. Compilar assets y ejecutar
```bash
# Compilar CSS/JS
npm run dev

# Iniciar servidor de desarrollo
php artisan serve
```

## 👥 Usuario de Prueba

Después de ejecutar los seeders, puedes acceder con:

- **Email**: `test@example.com`
- **Contraseña**: `admin123`

## 🏗️ Estructura del Proyecto

### Modelos Principales
```
├── Family (Familias de productos)
├── Category (Categorías)
├── Subcategory (Subcategorías)
├── Product (Productos)
├── Variant (Variantes de productos)
├── Option (Opciones: talla, color, etc.)
├── Feature (Características específicas)
└── Cover (Portadas del slider)
```

### Componentes Livewire
```
├── Navigation (Navegación principal)
├── Filter (Sistema de filtros)
├── Admin/
│   ├── Products/ (Gestión de productos)
│   ├── Options/ (Gestión de opciones)
│   └── Subcategories/ (Gestión de subcategorías)
```

### Rutas Principales
```
├── / (Página principal)
├── /families/{family} (Vista de familia)
├── /categories/{category} (Vista de categoría)
├── /subcategories/{subcategory} (Vista de subcategoría)
└── /admin/* (Panel administrativo)
```

## 🎨 Características del Diseño

### Sistema de Componentes
- **Navegación lateral** con categorías jerárquicas
- **Cards de productos** con hover effects
- **Filtros acordeón** con animaciones
- **Breadcrumbs** automáticos
- **Componentes reutilizables** (botones, inputs, etc.)

### Responsividad
- **Mobile First** approach
- **Breakpoints optimizados** para todos los dispositivos
- **Menú hamburguesa** en móvil
- **Grid adaptive** para productos

## 🔧 Comandos Útiles

```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ejecutar tests
php artisan test

# Generar nueva clave
php artisan key:generate

# Crear enlace simbólico
php artisan storage:link

# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders específicos
php artisan db:seed --class=FamilySeeder
php artisan db:seed --class=OptionSeeder

# Modo de desarrollo (watch)
npm run dev

# Compilar para producción
npm run build
```

## 📊 Seeders Incluidos

El proyecto incluye seeders completos con:

- **15+ Familias** de productos (Tecnología, Moda, Hogar, etc.)
- **100+ Categorías** organizadas jerárquicamente
- **600+ Subcategorías** detalladas
- **150 Productos** de ejemplo con imágenes
- **Opciones predefinidas** (Tallas, Colores, etc.)
- **Usuario administrador** de prueba

## 🚀 Despliegue en Producción

### Preparación
```bash
# Optimizar configuraciones
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compilar assets para producción
npm run build

# Optimizar autoloader
composer install --optimize-autoloader --no-dev
```

### Variables de entorno importantes
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# Configurar cache
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Configurar mail
MAIL_MAILER=smtp
MAIL_HOST=tu-servidor-smtp
```

## 🤝 Contribución

1. Fork el proyecto
2. Crea tu feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la branch (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Changelog

### v1.0.0 - 2025-08-08
- ✨ Lanzamiento inicial
- 🎉 Sistema completo de ecommerce
- 🛠️ Panel administrativo
- 📱 Diseño responsive
- 🔍 Sistema de filtros avanzado

## 🐛 Problemas Conocidos

- Las imágenes de productos generadas por Factory son placeholders
- El sistema de pagos está pendiente de implementación
- Las notificaciones push están en desarrollo

## 🔮 Roadmap

- [ ] Sistema de carrito de compras
- [ ] Integración con pasarelas de pago
- [ ] Sistema de reviews y calificaciones
- [ ] API RESTful completa
- [ ] App móvil con React Native
- [ ] Sistema de cupones y descuentos
- [ ] Integración con redes sociales
- [ ] Dashboard de analytics avanzado

## 📄 Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

## 👨‍💻 Autor

**YanlDev** - *Desarrollador Full Stack*

- GitHub: [@YanlDev](https://github.com/YanlDev)
- LinkedIn: [Tu LinkedIn]
- Email: info@yanidev.com

## 🙏 Agradecimientos

- Laravel Team por el increíble framework
- Livewire Team por la reactividad sin complicaciones
- Tailwind CSS por el sistema de diseño
- Jetstream por las funcionalidades de autenticación

---

⭐ **¿Te gustó el proyecto? ¡Dale una estrella en GitHub!** ⭐

*Desarrollado con ❤️ por YanlDev*
