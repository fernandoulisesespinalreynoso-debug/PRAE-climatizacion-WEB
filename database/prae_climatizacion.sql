-- Base de datos para PRAE Climatizacion WEB
-- Compatible con MySQL/MariaDB y phpMyAdmin en XAMPP.
-- El sitio PHP actual sigue usando los archivos de data/; este script prepara
-- la estructura para conectar el proyecto a la base de datos posteriormente.

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS prae_climatizacion
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE prae_climatizacion;

-- ---------------------------------------------------------------------------
-- Acceso al panel administrativo
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS admins (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL,
    nombre VARCHAR(120) NOT NULL,
    correo VARCHAR(190) NULL,
    contrasena_hash VARCHAR(255) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    ultimo_acceso DATETIME NULL,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_admins_usuario (usuario),
    UNIQUE KEY uq_admins_correo (correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuario demo equivalente al acceso actual del panel:
-- usuario: admin
-- contraseña: prae2026
-- La contraseña se almacena con password_hash() de PHP, nunca en texto plano.
INSERT INTO admins (
    id,
    usuario,
    nombre,
    correo,
    contrasena_hash,
    activo
) VALUES (
    1,
    'admin',
    'Administrador PRAE',
    NULL,
    '$2y$10$VwNYfFLSoJQY9TznWuYwW.25oov/ccgMp98hN/BtvywiWG5CMzypa',
    1
);

-- ---------------------------------------------------------------------------
-- Productos y categorias
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS categorias_productos (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL,
    codigo_icono VARCHAR(10) NULL,
    descripcion VARCHAR(255) NULL,
    orden SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_categorias_productos_nombre (nombre),
    UNIQUE KEY uq_categorias_productos_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categorias_productos (
    id,
    nombre,
    slug,
    codigo_icono,
    descripcion,
    orden,
    activo
) VALUES
    (1, 'Aires acondicionados', 'aires-acondicionados', 'AA', 'Piezas y accesorios', 1, 1),
    (2, 'Neveras', 'neveras', 'NV', 'Repuestos residenciales', 2, 1),
    (3, 'Refrigerantes', 'refrigerantes', 'RF', 'Gases y consumibles', 3, 1),
    (4, 'Herramientas', 'herramientas', 'HT', 'Equipos para técnicos', 4, 1),
    (5, 'Refrigeradores', 'refrigeradores', 'RG', 'Equipos y piezas', 5, 1),
    (6, 'Piezas eléctricas', 'piezas-electricas', 'PE', 'Capacitores y tarjetas', 6, 1),
    (7, 'Mantenimiento', 'mantenimiento', 'MT', 'Productos de limpieza', 7, 1),
    (8, 'General', 'general', 'GN', 'Otros productos', 8, 1);

CREATE TABLE IF NOT EXISTS productos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    categoria_id SMALLINT UNSIGNED NOT NULL,
    nombre VARCHAR(180) NOT NULL,
    slug VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(500) NULL,
    precio DECIMAL(12,2) NULL,
    disponible TINYINT(1) NOT NULL DEFAULT 1,
    destacado TINYINT(1) NOT NULL DEFAULT 0,
    orden SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_productos_slug (slug),
    KEY idx_productos_categoria (categoria_id),
    KEY idx_productos_estado (activo, disponible),
    CONSTRAINT fk_productos_categoria
        FOREIGN KEY (categoria_id)
        REFERENCES categorias_productos (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO productos (
    id,
    categoria_id,
    nombre,
    slug,
    descripcion,
    imagen,
    precio,
    disponible,
    destacado,
    orden,
    activo
) VALUES
    (
        1,
        1,
        'Capacitor para aire acondicionado',
        'capacitor-para-aire-acondicionado',
        'Pieza eléctrica para arranque y funcionamiento de equipos de climatización. Disponible en distintas capacidades.',
        'assets/img/products/piezas.svg',
        NULL,
        1,
        0,
        1,
        1
    ),
    (
        2,
        1,
        'Tarjeta universal para split',
        'tarjeta-universal-para-split',
        'Solución práctica para técnicos en reparaciones de aires acondicionados residenciales.',
        'assets/img/products/aire-split.svg',
        NULL,
        1,
        0,
        2,
        1
    ),
    (
        3,
        3,
        'Gas refrigerante',
        'gas-refrigerante',
        'Refrigerantes para mantenimiento y reparación. La compatibilidad depende del equipo.',
        'assets/img/products/gas.svg',
        NULL,
        1,
        0,
        3,
        1
    ),
    (
        4,
        2,
        'Termostato digital',
        'termostato-digital',
        'Control de temperatura para neveras y equipos de refrigeración residencial.',
        'assets/img/products/nevera.svg',
        NULL,
        1,
        0,
        4,
        1
    ),
    (
        5,
        2,
        'Compresor para nevera',
        'compresor-para-nevera',
        'Compresores sujetos a disponibilidad según modelo, voltaje y capacidad requerida.',
        'assets/img/products/refrigerador.svg',
        NULL,
        0,
        0,
        5,
        1
    ),
    (
        6,
        4,
        'Bomba de vacío para técnicos',
        'bomba-de-vacio-para-tecnicos',
        'Herramienta esencial para instalación y mantenimiento de sistemas de refrigeración.',
        'assets/img/products/herramientas.svg',
        NULL,
        1,
        0,
        6,
        1
    );

-- ---------------------------------------------------------------------------
-- Servicios
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS servicios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(180) NOT NULL,
    slug VARCHAR(200) NOT NULL,
    icono VARCHAR(32) NULL,
    imagen VARCHAR(500) NULL,
    descripcion TEXT NOT NULL,
    destacado TINYINT(1) NOT NULL DEFAULT 0,
    orden SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_servicios_slug (slug),
    KEY idx_servicios_estado (activo, destacado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO servicios (
    id,
    titulo,
    slug,
    icono,
    imagen,
    descripcion,
    destacado,
    orden,
    activo
) VALUES
    (
        1,
        'Reparación de aires acondicionados',
        'reparacion-de-aires-acondicionados',
        '🔧',
        'assets/img/services/reparacion.svg',
        'Diagnóstico y reparación de fallas eléctricas, enfriamiento deficiente, ruidos y problemas de funcionamiento.',
        1,
        1,
        1
    ),
    (
        2,
        'Mantenimiento preventivo',
        'mantenimiento-preventivo',
        '🧼',
        'assets/img/services/mantenimiento.svg',
        'Limpieza, revisión técnica y prevención de averías para mejorar el rendimiento del equipo.',
        1,
        2,
        1
    ),
    (
        3,
        'Instalación residencial',
        'instalacion-residencial',
        '🏠',
        'assets/img/services/instalacion.svg',
        'Instalación de equipos residenciales cuidando la ubicación, conexión y funcionamiento seguro.',
        1,
        3,
        1
    ),
    (
        4,
        'Asesoramiento antes de comprar',
        'asesoramiento-antes-de-comprar',
        '💬',
        'assets/img/services/asesoria.svg',
        'Orientación para elegir piezas, equipos o soluciones que realmente convienen al cliente.',
        1,
        4,
        1
    );

-- ---------------------------------------------------------------------------
-- Ofertas
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ofertas (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(180) NOT NULL,
    slug VARCHAR(200) NOT NULL,
    etiqueta VARCHAR(80) NULL,
    imagen VARCHAR(500) NULL,
    descripcion TEXT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    destacada TINYINT(1) NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_ofertas_slug (slug),
    KEY idx_ofertas_fechas (fecha_inicio, fecha_fin),
    KEY idx_ofertas_estado (activo, destacada)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO ofertas (
    id,
    titulo,
    slug,
    etiqueta,
    imagen,
    descripcion,
    fecha_inicio,
    fecha_fin,
    destacada,
    activo
) VALUES
    (
        1,
        'Oferta para técnicos',
        'oferta-para-tecnicos',
        'Destacada',
        'assets/img/products/herramientas.svg',
        'Espacio preparado para publicar ofertas de herramientas, piezas y consumibles.',
        '2026-06-01',
        '2026-06-30',
        1,
        1
    ),
    (
        2,
        'Combo de mantenimiento',
        'combo-de-mantenimiento',
        'Residencial',
        'assets/img/services/mantenimiento.svg',
        'Oferta temporal para servicios de mantenimiento residencial. Pendiente de precio final.',
        '2026-06-01',
        '2026-07-15',
        0,
        1
    ),
    (
        3,
        'Piezas seleccionadas',
        'piezas-seleccionadas',
        'Inventario',
        'assets/img/products/piezas.svg',
        'Bloque listo para conectar con el catálogo real y destacar productos disponibles.',
        '2026-06-10',
        '2026-07-10',
        0,
        1
    );

-- ---------------------------------------------------------------------------
-- Trabajos realizados
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS tipos_trabajo (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (id),
    UNIQUE KEY uq_tipos_trabajo_nombre (nombre),
    UNIQUE KEY uq_tipos_trabajo_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tipos_trabajo (id, nombre, slug, activo) VALUES
    (1, 'Aire acondicionado', 'aire-acondicionado', 1),
    (2, 'Nevera', 'nevera', 1),
    (3, 'Refrigerador', 'refrigerador', 1),
    (4, 'Mantenimiento', 'mantenimiento', 1);

CREATE TABLE IF NOT EXISTS trabajos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tipo_trabajo_id SMALLINT UNSIGNED NULL,
    titulo VARCHAR(180) NOT NULL,
    slug VARCHAR(200) NOT NULL,
    imagen VARCHAR(500) NULL,
    video VARCHAR(500) NULL,
    descripcion TEXT NOT NULL,
    fecha_realizacion DATE NULL,
    destacado TINYINT(1) NOT NULL DEFAULT 0,
    orden SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_trabajos_slug (slug),
    KEY idx_trabajos_tipo (tipo_trabajo_id),
    KEY idx_trabajos_estado (activo, destacado),
    CONSTRAINT fk_trabajos_tipo
        FOREIGN KEY (tipo_trabajo_id)
        REFERENCES tipos_trabajo (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO trabajos (
    id,
    tipo_trabajo_id,
    titulo,
    slug,
    imagen,
    video,
    descripcion,
    fecha_realizacion,
    destacado,
    orden,
    activo
) VALUES
    (
        1,
        1,
        'Mantenimiento de aire acondicionado residencial',
        'mantenimiento-de-aire-acondicionado-residencial',
        'assets/img/works/trabajo-aire.svg',
        NULL,
        'Tarjeta preparada para colocar videos reales de trabajos realizados.',
        NULL,
        0,
        1,
        1
    ),
    (
        2,
        2,
        'Reparación de nevera',
        'reparacion-de-nevera',
        'assets/img/works/trabajo-nevera.svg',
        NULL,
        'Espacio para evidenciar antes, durante y después del servicio.',
        NULL,
        0,
        2,
        1
    ),
    (
        3,
        4,
        'Revisión técnica y diagnóstico',
        'revision-tecnica-y-diagnostico',
        'assets/img/works/trabajo-mantenimiento.svg',
        NULL,
        'Ideal para generar confianza con clientes residenciales y técnicos.',
        NULL,
        0,
        3,
        1
    );

-- ---------------------------------------------------------------------------
-- Consejos y contenido de ayuda
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS categorias_consejos (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (id),
    UNIQUE KEY uq_categorias_consejos_nombre (nombre),
    UNIQUE KEY uq_categorias_consejos_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categorias_consejos (id, nombre, slug, activo) VALUES
    (1, 'Consejo técnico', 'consejo-tecnico', 1),
    (2, 'Compra segura', 'compra-segura', 1),
    (3, 'Climatización', 'climatizacion', 1);

CREATE TABLE IF NOT EXISTS consejos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    categoria_consejo_id SMALLINT UNSIGNED NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    slug VARCHAR(220) NOT NULL,
    resumen TEXT NOT NULL,
    contenido LONGTEXT NULL,
    imagen VARCHAR(500) NULL,
    meta_descripcion VARCHAR(320) NULL,
    publicado_en DATETIME NULL,
    orden SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_consejos_slug (slug),
    KEY idx_consejos_categoria (categoria_consejo_id),
    KEY idx_consejos_publicacion (activo, publicado_en),
    CONSTRAINT fk_consejos_categoria
        FOREIGN KEY (categoria_consejo_id)
        REFERENCES categorias_consejos (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO consejos (
    id,
    categoria_consejo_id,
    titulo,
    slug,
    resumen,
    contenido,
    imagen,
    meta_descripcion,
    publicado_en,
    orden,
    activo
) VALUES
    (
        1,
        1,
        'Señales de que tu aire necesita mantenimiento',
        'senales-de-que-tu-aire-necesita-mantenimiento',
        'Si enfría menos, gotea o hace ruidos extraños, conviene revisarlo antes de que la falla sea mayor.',
        NULL,
        NULL,
        'Señales comunes que indican cuándo un aire acondicionado necesita mantenimiento.',
        '2026-06-01 09:00:00',
        1,
        1
    ),
    (
        2,
        2,
        'Antes de comprar una pieza, confirma el modelo',
        'antes-de-comprar-una-pieza-confirma-el-modelo',
        'Una foto clara de la etiqueta del equipo ayuda a elegir la pieza correcta y evita gastos innecesarios.',
        NULL,
        NULL,
        'Cómo confirmar el modelo del equipo antes de comprar una pieza de refrigeración.',
        '2026-06-01 09:00:00',
        2,
        1
    ),
    (
        3,
        3,
        'El confort también depende de la instalación',
        'el-confort-tambien-depende-de-la-instalacion',
        'Una buena ubicación, drenaje correcto y revisión eléctrica mejoran el rendimiento del equipo.',
        NULL,
        NULL,
        'Factores de instalación que mejoran el rendimiento de los equipos de climatización.',
        '2026-06-01 09:00:00',
        3,
        1
    );

CREATE TABLE IF NOT EXISTS preguntas_frecuentes (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pregunta VARCHAR(255) NOT NULL,
    respuesta TEXT NOT NULL,
    orden SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_preguntas_frecuentes_estado (activo, orden)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO preguntas_frecuentes (
    id,
    pregunta,
    respuesta,
    orden,
    activo
) VALUES
    (
        1,
        '¿Puedo cotizar por WhatsApp?',
        'Sí. Los botones de productos, servicios y ofertas abren WhatsApp con un mensaje preparado.',
        1,
        1
    ),
    (
        2,
        '¿Los productos tienen disponibilidad?',
        'Sí. Cada producto muestra si está disponible o no disponible.',
        2,
        1
    ),
    (
        3,
        '¿La página funciona en celular?',
        'Sí. El diseño se adapta a teléfonos, tablets y computadoras.',
        3,
        1
    ),
    (
        4,
        '¿Se puede administrar el catálogo?',
        'La interfaz del admin está preparada. La conexión real se hará cuando se agregue la base de datos.',
        4,
        1
    );

-- ---------------------------------------------------------------------------
-- Comentarios, contacto y solicitudes de cotizacion
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS comentarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(120) NOT NULL,
    correo VARCHAR(190) NULL,
    comentario TEXT NOT NULL,
    estado ENUM('pendiente', 'aprobado', 'rechazado') NOT NULL DEFAULT 'pendiente',
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_comentarios_estado_fecha (estado, creado_en)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO comentarios (
    id,
    nombre,
    correo,
    comentario,
    estado
) VALUES
    (
        1,
        'Cliente residencial',
        NULL,
        'Excelente atención y orientación antes de comprar la pieza.',
        'aprobado'
    ),
    (
        2,
        'Técnico aliado',
        NULL,
        'Muy útil encontrar productos organizados por categorías.',
        'aprobado'
    );

CREATE TABLE IF NOT EXISTS mensajes_contacto (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(120) NOT NULL,
    correo VARCHAR(190) NULL,
    telefono VARCHAR(30) NULL,
    asunto VARCHAR(180) NULL,
    mensaje TEXT NOT NULL,
    estado ENUM('nuevo', 'leido', 'respondido', 'archivado') NOT NULL DEFAULT 'nuevo',
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_mensajes_contacto_estado_fecha (estado, creado_en),
    KEY idx_mensajes_contacto_correo (correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS solicitudes_cotizacion (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    producto_id INT UNSIGNED NULL,
    servicio_id INT UNSIGNED NULL,
    tipo ENUM('producto', 'servicio', 'otro') NOT NULL DEFAULT 'otro',
    item_solicitado VARCHAR(200) NOT NULL,
    nombre_cliente VARCHAR(120) NULL,
    correo VARCHAR(190) NULL,
    telefono VARCHAR(30) NULL,
    cantidad INT UNSIGNED NOT NULL DEFAULT 1,
    modelo_equipo VARCHAR(180) NULL,
    urgencia ENUM('normal', 'urgente') NOT NULL DEFAULT 'normal',
    precio_base_estimado DECIMAL(12,2) NULL,
    total_estimado DECIMAL(12,2) NULL,
    detalles TEXT NULL,
    estado ENUM('nueva', 'en_revision', 'cotizada', 'cerrada', 'cancelada')
        NOT NULL DEFAULT 'nueva',
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_solicitudes_producto (producto_id),
    KEY idx_solicitudes_servicio (servicio_id),
    KEY idx_solicitudes_estado_fecha (estado, creado_en),
    CONSTRAINT fk_solicitudes_producto
        FOREIGN KEY (producto_id)
        REFERENCES productos (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    CONSTRAINT fk_solicitudes_servicio
        FOREIGN KEY (servicio_id)
        REFERENCES servicios (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------------
-- Configuracion general y redes sociales
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS configuracion_sitio (
    id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre_empresa VARCHAR(180) NOT NULL,
    nombre_corto VARCHAR(100) NOT NULL,
    eslogan VARCHAR(255) NULL,
    anios_experiencia SMALLINT UNSIGNED NULL,
    whatsapp VARCHAR(30) NULL,
    telefono_visible VARCHAR(60) NULL,
    correo VARCHAR(190) NULL,
    direccion VARCHAR(255) NULL,
    horario TEXT NULL,
    palabras_clave_seo TEXT NULL,
    logo VARCHAR(500) NULL,
    favicon VARCHAR(500) NULL,
    icono_app VARCHAR(500) NULL,
    moneda CHAR(3) NOT NULL DEFAULT 'DOP',
    zona_horaria VARCHAR(64) NOT NULL DEFAULT 'America/Santo_Domingo',
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO configuracion_sitio (
    id,
    nombre_empresa,
    nombre_corto,
    eslogan,
    anios_experiencia,
    whatsapp,
    telefono_visible,
    correo,
    direccion,
    horario,
    palabras_clave_seo,
    logo,
    favicon,
    icono_app,
    moneda,
    zona_horaria
) VALUES (
    1,
    'PRAE Refrigeración y Climatización Espinal',
    'PRAE Refrigeración',
    'Tu comodidad y confort es nuestra satisfacción',
    12,
    '18093039156',
    NULL,
    NULL,
    NULL,
    NULL,
    'refrigeración, técnicos de refrigeración, piezas de aire acondicionado, neveras, reparación de aire acondicionado, mantenimiento residencial, climatización',
    'assets/img/logo-prae-header.png',
    'assets/img/favicon.png',
    'assets/img/app-icon.png',
    'DOP',
    'America/Santo_Domingo'
);

CREATE TABLE IF NOT EXISTS redes_sociales (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    configuracion_id TINYINT UNSIGNED NOT NULL,
    plataforma VARCHAR(50) NOT NULL,
    url VARCHAR(500) NOT NULL,
    orden SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_redes_configuracion_plataforma (configuracion_id, plataforma),
    CONSTRAINT fk_redes_configuracion
        FOREIGN KEY (configuracion_id)
        REFERENCES configuracion_sitio (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO redes_sociales (
    id,
    configuracion_id,
    plataforma,
    url,
    orden,
    activo
) VALUES
    (1, 1, 'TikTok', '#', 1, 0),
    (2, 1, 'Facebook', '#', 2, 0);
