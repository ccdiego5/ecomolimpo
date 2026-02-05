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

## 🚀 Próximos Widgets

Este es el primer widget. Se pueden agregar más widgets en el futuro:
- Botones personalizados
- Tarjetas de servicios
- Testimonios
- Y más...

## 📞 Soporte

Desarrollado por **Diego Cárdenas** para **Ecomolimpo**

---

Copyright © 2025 Diego Cárdenas - Ecomolimpo. Todos los derechos reservados.
