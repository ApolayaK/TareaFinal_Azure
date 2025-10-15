# 🚀 GUÍA RÁPIDA - Proceso Paso a Paso

## Resumen del Proyecto CRUD Periodistas en Azure

---

## 📋 PASO 1: CREAR RECURSOS EN AZURE

### 1.1 Crear Grupo de Recursos
1. Ir a **Azure Portal** → Buscar "Grupos de recursos"
2. Clic en **"+ Crear"**
3. Configuración:
   - **Suscripción:** Azure for Students
   - **Nombre:** `1501692azure`
   - **Región:** Chile Central (más cercana)
4. **Etiquetas:** Dejar vacío
5. **Revisar y crear** → Crear

---

## 🗄️ PASO 2: CREAR BASE DE DATOS SQL

### 2.1 Crear SQL Server
1. Buscar **"Azure SQL"** → **"Servidores SQL"**
2. **"+ Crear"**
3. Configuración:
   - **Grupo de recursos:** `1501692azure` (seleccionar el creado)
   - **Nombre del servidor:** `apolayaserver`
   - **Ubicación:** Chile Central
   - **Método de autentificación:** SQL + Microsoft Entra
   - **Usuario administrador:** `apolayaadmin`
   - **Contraseña:** `Apolaya123@@`
4. **"Configurar administrador de Microsoft Entra"**:
   - Establecer administrador → Seleccionar tu correo Microsoft
   - Aceptar
5. **Revisar y crear** → Crear

### 2.2 Crear Base de Datos
1. En el servidor creado → **"Bases de datos SQL"** → **"+ Crear"**
2. Configuración:
   - **Nombre de BD:** `atv`
   - **Servidor:** `apolayaserver` (ya seleccionado)
   - **Entorno de carga de trabajo:** Producción
3. **"Configurar base de datos"**:
   - Cambiar a **"Básico"** (más económico)
   - **Aplicar**
4. Seguir a **"Redes"**:
   - **Método de conectividad:** Punto de conexión público
   - ☑️ **Permitir servicios de Azure:** SÍ
   - ☑️ **Agregar dirección IP del cliente actual:** SÍ
5. **Revisar y crear** → Crear

---

## 🔐 PASO 3: CONFIGURAR FIREWALL Y CREAR TABLA

### 3.1 Agregar IP al Firewall
1. Ir al servidor **apolayaserver**
2. Menú lateral → **"Redes"**
3. En **"Reglas de firewall"**:
   - ☑️ Activar "Permitir servicios de Azure"
   - Agregar tu **dirección IPv4 del cliente**
4. **Guardar**

### 3.2 Crear Tabla en Editor de Consultas
1. Ir a la base de datos **atv**
2. Menú lateral → **"Editor de consultas (versión preliminar)"**
3. **Autenticarse:**
   - **SQL Server:** Usuario `apolayaadmin` + Contraseña
   - **Microsoft Entra:** Continuar con tu correo
4. **Ejecutar script SQL:**

```sql
CREATE TABLE periodistas (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    medio VARCHAR(100),
    especialidad VARCHAR(50),
    email VARCHAR(100),
    telefono VARCHAR(20)
);

INSERT INTO periodistas (nombre, apellido, medio, especialidad, email, telefono)
VALUES 
('Carlos', 'Rodríguez', 'El Comercio', 'Deportes', 'carlos@elcomercio.pe', '987654321'),
('María', 'González', 'RPP', 'Política', 'maria@rpp.pe', '965432187');

SELECT * FROM periodistas;
```

5. Verificar que se insertaron los datos

---

## 💻 PASO 4: CONFIGURAR ENTORNO LOCAL

### 4.1 Instalar MSODBCSQL
1. Ejecutar instalador **msodbcsql17.msi** (de carpeta `instaladores/`)
2. Seguir asistente de instalación
3. Reiniciar sistema

### 4.2 Copiar Drivers PHP
1. Copiar archivos de carpeta `instaladores/`:
   - `php_pdo_sqlsrv.dll`
   - `php_sqlsrv.dll`
2. Pegar en: **`C:\xampp\php\ext\`**

### 4.3 Configurar php.ini
1. Abrir **`C:\xampp\php\php.ini`**
2. Agregar al final:

```ini
extension=php_sqlsrv
extension=php_pdo_sqlsrv
```

3. Guardar archivo

### 4.4 Reiniciar Apache
1. Abrir **Panel de Control XAMPP**
2. **Stop Apache** → **Start Apache**

---

## 📝 PASO 5: CREAR ARCHIVOS PHP

### 5.1 Crear carpeta del proyecto
```
Crear carpeta: TareaFinal_Azure/
```

### 5.2 Crear archivo db.php (conexión)

```php
<?php
$serverName = "apolayaserver.database.windows.net,1433"; 
$database = "atv"; 
$username = "apolayaadmin"; 
$password = "Apolaya123@@"; 

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ ERROR: " . $e->getMessage());
}
?>
```

### 5.3 Crear archivos CRUD
- **index.php** → Listar periodistas
- **create.php** → Agregar periodista
- **edit.php** → Editar periodista
- **delete.php** → Eliminar periodista
- **style.css** → Estilos

---

## 🧪 PASO 6: PROBAR LOCALMENTE

### 6.1 Iniciar servidor PHP

```bash
cd ruta/del/proyecto
php -S localhost:8080
```

### 6.2 Probar en navegador
```
http://localhost:8080
```

### 6.3 Verificar funcionalidades:
- ✅ Listar periodistas
- ✅ Agregar nuevo
- ✅ Editar existente
- ✅ Eliminar con confirmación

**Si todo funciona → Continuar al siguiente paso**

---

## 🌐 PASO 7: SUBIR A GITHUB

### 7.1 Crear repositorio en GitHub
1. Ir a **github.com**
2. **"+ New repository"**
3. Nombre: **TareaFinal_Azure**
4. Público
5. **Create repository**

### 7.2 Subir código

```bash
cd TareaFinal_Azure
git init
git add .
git commit -m "CRUD Periodistas completo"
git branch -M main
git remote add origin https://github.com/TuUsuario/TareaFinal_Azure.git
git push -u origin main
```

---

## ☁️ PASO 8: CREAR APP SERVICE EN AZURE

### 8.1 Crear App Service
1. Buscar **"App Services"** → **"+ Crear"**
2. Configuración:
   - **Grupo de recursos:** `1501692azure`
   - **Nombre:** `rg-proyecto-final` (debe ser único)
   - **Publicar:** Código
   - **Pila del entorno:** PHP 8.2
   - **Sistema operativo:** Linux
   - **Región:** Chile Central
   - **Plan:** Básico B1

3. Pestaña **"Implementación"**:
   - ☑️ **Habilitar implementación continua:** SÍ
   - **Cuenta GitHub:** Tu cuenta
   - **Repositorio:** TareaFinal_Azure
   - **Rama:** main

4. **Revisar y crear** → Crear
5. Esperar 3-5 minutos

---

## ⚙️ PASO 9: CONFIGURAR VARIABLES DE ENTORNO

### 9.1 Agregar variables
1. Ir al App Service **rg-proyecto-final**
2. Menú lateral → **"Configuración"** → **"Variables de entorno"**
3. Agregar 4 variables (clic en **"+ Agregar"**):

| Nombre | Valor |
|--------|-------|
| `DB_HOST` | `apolayaserver.database.windows.net,1433` |
| `DB_USERNAME` | `apolayaadmin` |
| `DB_PASSWORD` | `Apolaya123@@` |
| `DB_DATABASE` | `atv` |

4. **Guardar** (arriba)
5. Confirmar reinicio

---

## 🎉 PASO 10: PROBAR EN PRODUCCIÓN

### 10.1 Obtener URL
1. En App Service → **"Información general"**
2. Ver **"Dominio predeterminado"**:
   ```
   https://rg-proyecto-final.azurewebsites.net
   ```

### 10.2 Verificar funcionamiento
1. Abrir URL en navegador
2. Probar todas las funcionalidades
3. Verificar SSL (candado verde)

---

## ✅ CHECKLIST FINAL

### Base de Datos:
- [x] SQL Server creado
- [x] Base de datos `atv` creada
- [x] Tabla `periodistas` con datos
- [x] Firewall configurado

### Desarrollo:
- [x] Código PHP funcional
- [x] Pruebas locales exitosas
- [x] Subido a GitHub

### Azure:
- [x] App Service creado
- [x] Variables de entorno configuradas
- [x] Deployment automático activo
- [x] Aplicación accesible públicamente

---

## 🔧 SOLUCIÓN DE PROBLEMAS COMUNES

### ❌ "Cannot open server"
**Solución:** Agregar tu IP en Firewall del SQL Server

### ❌ "Could not find driver"
**Solución:** Verificar extensiones en php.ini y reiniciar Apache

### ❌ App Service no actualiza
**Solución:** Verificar logs en Centro de implementación

### ❌ Error 500 en Azure
**Solución:** Revisar variables de entorno y logs

---

## 📊 COSTOS APROXIMADOS

| Recurso | Costo mensual |
|---------|---------------|
| SQL Server | $0 |
| SQL Database (Básico) | ~$5 |
| App Service (B1) | ~$13 |
| **TOTAL** | **~$18/mes** |

---
