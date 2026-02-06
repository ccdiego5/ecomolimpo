# 🎨 Ecomolimpo Widgets - Instrucciones de Uso

Plugin desarrollado por **Diego Cárdenas** para **Ecomolimpo**

## 📦 Instalación

1. El plugin ya está en la carpeta correcta: `wp-content/plugins/ecomolimpo-widgets/`
2. Ve a **WordPress Admin** → **Plugins**
3. Busca "**Ecomolimpo Widgets**"
4. Haz clic en **"Activar"**

## ✅ Requisitos

- ✔️ WordPress 5.8 o superior
- ✔️ Elementor 3.0.0 o superior (ya lo tienes instalado)
- ✔️ PHP 7.4 o superior

## 🎯 Cómo Usar el Widget de Contador Regresivo

### 1. Crear una Página con Elementor

1. Ve a **Páginas** → **Añadir nueva**
2. Haz clic en **"Editar con Elementor"**

### 2. Agregar el Widget

1. En el panel izquierdo de Elementor, busca la categoría **"Ecomolimpo Widgets"**
2. Arrastra el widget **"Contador Regresivo"** a tu página
3. ¡Listo! El contador ya está funcionando

### 3. Configurar el Widget

#### ⚙️ Configuración del Contador (Pestaña "Contenido")

**Estilo del Contador:**
- **Inline (Una línea):** Todo en una sola línea, estilo minimalista (como "PUBLIC ACCESS IS CLOSING IN 26:03")
- **Cajas Separadas:** Números en cajas individuales con fondos y bordes

**Formato de Tiempo:**
- **HH:MM:SS:** Muestra horas, minutos y segundos
- **MM:SS:** Muestra solo minutos y segundos (recomendado para estilo inline)

**Minutos Mínimos y Máximos:**
- Define el rango de tiempo aleatorio
- Ejemplo: Min: 20, Max: 30 = el contador empezará entre 20 y 30 minutos
- El tiempo es aleatorio pero se mantiene en localStorage

**Texto Antes del Contador:**
- Texto que aparece arriba del contador
- Ejemplo: "ACCESO PÚBLICO CERRARÁ EN"
- Puedes dejarlo vacío si no lo necesitas

**Mostrar Etiquetas:**
- Activa para mostrar "Horas", "Minutos", "Segundos"
- Desactiva para mostrar solo los números

#### 🎨 Personalización de Estilos (Pestaña "Estilo")

**1. Estilo del Texto:**
- Color del texto superior
- Tipografía (fuente, tamaño, peso)
- Margen inferior
- Alineación (izquierda, centro, derecha)

**2. Estilo de Números:**
- Color de los números del contador
- Tipografía de los números
- Color de fondo de cada item
- Espaciado interno (padding)
- Redondeo de bordes
- Espacio entre items

**3. Estilo de Etiquetas:**
- Color de las etiquetas
- Tipografía de las etiquetas
- Margen superior

**4. Estilo del Contenedor:**
- Alineación del contador completo
- Color de fondo del contenedor
- Espaciado interno del contenedor

## 🎯 Ejemplos de Configuración

### Estilo 1: Inline (Como en la esquina superior)

Para replicar el contador que aparece en la esquina superior de The Final Protocol:

**Configuración:**
- **Estilo del Contador:** Inline (Una línea)
- **Formato de Tiempo:** MM:SS
- **Minutos Mínimos:** 20
- **Minutos Máximos:** 40
- **Texto:** "PUBLIC ACCESS IS CLOSING IN"

**Estilos:**
- **Texto - Color:** `#FFFFFF` (blanco)
- **Números - Color:** `#FFD700` (amarillo dorado)
- **Números - Tamaño:** 18px
- **Contenedor - Alineación:** Derecha (para esquina superior)

### Estilo 2: Cajas Separadas (Más visual)

Para un contador más prominente con cajas:

**Configuración:**
- **Estilo del Contador:** Cajas Separadas
- **Formato de Tiempo:** HH:MM:SS o MM:SS
- **Minutos Mínimos:** 20
- **Minutos Máximos:** 30
- **Texto:** "ACCESO PÚBLICO CERRARÁ EN"
- **Mostrar Etiquetas:** No (o Sí si quieres)

**Estilos:**
- **Texto - Color:** `#FFFFFF` (blanco)
- **Texto - Alineación:** Centro
- **Números - Color:** `#00FF85` (verde neón)
- **Números - Fondo:** `#0A0A0A` (negro oscuro)
- **Números - Tamaño:** 56px
- **Números - Redondeo:** 12px
- **Contenedor - Alineación:** Centro

## 💾 Cómo Funciona el localStorage

1. **Primera Visita:** 
   - Se genera un tiempo aleatorio entre el rango configurado
   - Se guarda en localStorage del navegador

2. **Recargas de Página:**
   - El contador continúa desde donde estaba
   - No se reinicia

3. **Cuando Llega a Cero:**
   - Se genera un nuevo tiempo aleatorio
   - Se guarda el nuevo tiempo en localStorage

4. **Diferente Navegador/Dispositivo:**
   - Cada navegador tiene su propio localStorage
   - Generará un tiempo diferente

5. **Borrar Caché:**
   - Si el usuario borra el localStorage, se genera un nuevo tiempo

## 🔧 Solución de Problemas

### El widget no aparece en Elementor

1. Verifica que el plugin esté activado en **Plugins**
2. Actualiza la página de Elementor (Ctrl + R)
3. Verifica que Elementor esté actualizado

### El contador no cuenta

1. Abre la consola del navegador (F12)
2. Busca errores en JavaScript
3. Verifica que jQuery esté cargado

### El contador no se guarda entre sesiones

1. Verifica que localStorage esté habilitado en el navegador
2. No uses modo incógnito (no guarda localStorage)
3. Verifica que no haya extensiones bloqueando localStorage

## 📱 Responsive

El widget es completamente responsive:
- **Desktop:** Números grandes, espaciado amplio
- **Tablet:** Números medianos
- **Mobile:** Números más pequeños, espaciado reducido

## 🎥 Widget de Video Player Avanzado (con Plyr)

Un reproductor de video moderno y mejorado que soporta YouTube, Vimeo y archivos MP4 alojados.

### ✨ Características

- 🎬 Soporte para **YouTube**, **Vimeo** y **MP4 alojado**
- 🎨 Interfaz moderna y personalizable con **Plyr**
- ⚙️ Controles completos y personalizables
- 🔄 Autoplay, loop y silenciado
- 🖼️ Imagen de portada personalizable
- 📐 Múltiples relaciones de aspecto (16:9, 4:3, 21:9, 1:1)
- 🎨 Bordes, sombras y estilos personalizables

### 🎯 Cómo Usar

#### 1. Agregar el Widget

1. Edita tu página con Elementor
2. Busca **"Video Player Avanzado"** en la categoría **"Ecomolimpo Widgets"**
3. Arrastra el widget a tu página

#### 2. Configuración

##### Pestaña "Contenido"

**Tipo de Video:**
- **YouTube:** Pega la URL completa de YouTube
  - Ejemplo: `https://www.youtube.com/watch?v=bTqVqk7FSmY`
- **Vimeo:** Pega la URL completa de Vimeo
  - Ejemplo: `https://vimeo.com/76979871`
- **Video Alojado (MP4):** Sube tu archivo de video MP4

**Imagen de Portada:**
- Sube una imagen personalizada que se muestra antes de reproducir el video

##### Opciones del Reproductor

- **Reproducción Automática:** Inicia el video automáticamente al cargar la página
- **Silenciado por Defecto:** El video comienza sin sonido
- **Repetir Video:** El video se reproduce en bucle infinito
- **Mostrar Controles:** Muestra/oculta los controles del reproductor
- **Click para Reproducir:** Permite reproducir haciendo clic en el video

##### Pestaña "Estilos"

**Relación de Aspecto:**
- 16:9 (YouTube estándar)
- 4:3 (Clásico)
- 21:9 (Ultra wide)
- 1:1 (Cuadrado)
- Personalizado (altura automática)

**Bordes y Sombras:**
- Agrega bordes personalizados
- Aplica radio a las esquinas
- Añade sombras para profundidad

### 📋 Ejemplo de Uso: Video de YouTube

**Configuración:**
- **Tipo de Video:** YouTube
- **URL:** `https://www.youtube.com/watch?v=dQw4w9WgXcQ`
- **Reproducción Automática:** No
- **Mostrar Controles:** Sí
- **Relación de Aspecto:** 16:9

**Estilos:**
- **Radio del Borde:** 12px en todas las esquinas
- **Sombra:** Box shadow suave para profundidad

### 🎨 Ventajas sobre el Widget Nativo de WordPress

1. **Interfaz Moderna:** Plyr ofrece un diseño mucho más atractivo
2. **Soporte Multi-Plataforma:** YouTube, Vimeo y MP4 en un solo widget
3. **Más Controles:** Configuración de velocidad, calidad y más
4. **Responsive Superior:** Se adapta perfectamente a todos los dispositivos
5. **Teclado:** Soporte completo para atajos de teclado (espacio, flechas, etc.)
6. **Accesibilidad:** Mejor soporte para lectores de pantalla

## 🚀 Widgets Disponibles

- ✅ **Contador Regresivo** - Temporizador con localStorage
- ✅ **Live Event Banner** - Banner de evento en vivo
- ✅ **Video Player Avanzado** - Reproductor con Plyr
- ✅ **Botón Animado** - Botón con borde parpadeante

## ✨ Widget de Botón Animado

Un botón llamativo con borde parpadeante perfecto para llamadas a la acción (CTA).

### 🎯 Características

- ✨ **Borde parpadeante** con efecto de glow personalizable
- ⚡ **Velocidad ajustable** de 100ms a 2000ms
- 💫 **Intensidad de glow** configurable
- 📝 Texto principal + subtítulo opcional
- 🎨 Totalmente personalizable
- 🔗 Soporte completo de enlaces
- 📱 Completamente responsive

### 🎯 Cómo Usar

#### 1. Agregar el Widget

1. Edita tu página con Elementor
2. Busca **"Botón Animado"** en la categoría **"Ecomolimpo Widgets"**
3. Arrastra el widget a tu página

#### 2. Configuración

##### Pestaña "Contenido"

**Texto del Botón:**
- Texto principal que aparece en el botón
- Ejemplo: "CLAIM YOUR FREE SPOT"

**Subtítulo:**
- Texto secundario debajo del principal (opcional)
- Ejemplo: "Sunday December 28th @6PM CET"

**Enlace:**
- URL a la que redirige el botón
- Opciones para abrir en nueva ventana
- Atributo nofollow disponible

**Alineación:**
- Izquierda, Centro o Derecha
- Responsive (diferente alineación por dispositivo)

##### Pestaña "Estilos del Botón"

**Color de Fondo:**
- Color del botón
- Predeterminado: Cyan (#00D9FF)

**Tipografía del Texto:**
- Fuente, tamaño, peso, transformación
- Totalmente personalizable

**Color del Texto:**
- Color del texto principal
- Predeterminado: Negro (#000000)

**Padding:**
- Espaciado interno del botón
- Control independiente por lado

**Radio del Borde:**
- Redondeo de las esquinas
- Predeterminado: 50px (totalmente redondeado)

##### Pestaña "Estilos del Subtítulo"

**Tipografía:**
- Fuente, tamaño, peso para el subtítulo

**Color:**
- Color del subtítulo

**Margen Superior:**
- Espacio entre el texto principal y el subtítulo

##### Pestaña "Animación del Borde"

**Grosor del Borde:**
- Ancho del borde en píxeles (1px - 10px)
- Predeterminado: 2px

**Color del Borde:**
- Color del borde animado
- Predeterminado: Negro (#000000)

**Velocidad de Animación:**
- Duración del ciclo de parpadeo
- Rango: 100ms - 2000ms
- Predeterminado: 500ms (como en The Final Protocol)

**Intensidad del Glow:**
- Qué tan brillante es el efecto de glow
- Rango: 0px - 30px
- Predeterminado: 15px

### 📋 Ejemplo de Uso: Botón Estilo "Claim Your Spot"

**Configuración:**
- **Texto:** "CLAIM YOUR FREE SPOT"
- **Subtítulo:** "Sunday December 28th @6PM CET"
- **Enlace:** Tu URL de registro
- **Alineación:** Centro

**Estilos del Botón:**
- **Color de Fondo:** `#00D9FF` (Cyan)
- **Color del Texto:** `#000000` (Negro)
- **Padding:** 20px arriba/abajo, 40px izquierda/derecha
- **Radio del Borde:** 50px (totalmente redondeado)

**Animación del Borde:**
- **Grosor:** 2px
- **Color:** `#000000` (Negro)
- **Velocidad:** 500ms
- **Intensidad Glow:** 15px

### 🎨 Ejemplos de Variaciones

#### Botón Rojo Urgente
- **Fondo:** `#E11D48` (Rojo)
- **Texto:** `#FFFFFF` (Blanco)
- **Borde:** `#FFFFFF` (Blanco)
- **Velocidad:** 300ms (más rápido = más urgencia)
- **Glow:** 20px (más intenso)

#### Botón Verde Éxito
- **Fondo:** `#10B981` (Verde)
- **Texto:** `#FFFFFF` (Blanco)
- **Borde:** `#FFFFFF` (Blanco)
- **Velocidad:** 700ms (más lento = más elegante)
- **Glow:** 12px (más sutil)

#### Botón Morado Premium
- **Fondo:** `#8F79FA` (Morado)
- **Texto:** `#FFFFFF` (Blanco)
- **Borde:** `#EFD915` (Dorado)
- **Velocidad:** 600ms
- **Glow:** 18px

## 📞 Soporte

Desarrollado por **Diego Cárdenas** para **Ecomolimpo**

---

Copyright © 2025 Diego Cárdenas - Ecomolimpo. Todos los derechos reservados.
