# Halfegg ~ 0.0.7
A complete Client/User registration and customer portal web aplication

Este sistema permite crear usuarios desde un panel de administrador, lo que genera un enlace que el usuario/cliente usará posteriormente para activar su cuenta, y tener acceso a la sección reservada para usuarios registrados en el sitio web en donde se muestra informacion reservada estrictamente para el usuario validado.

El sistema es util para usarse en sistemas de Portal de clientes, administracion de cuentas, base de datos de clientes, registro de visitas, listas de invitados y muchisimas posibilidades mas.

Los perfiles de usuarios pueden ser editados dede el panel del administrador.

Los usuarios tienen un rol que les permite o no crear, editar o ver la informacion relativa al usuario,
La informacion de los usuarios registrada en la base de datos se compone de:
    _ Perfil
    _ Item

En donde el perfil es un conjuto de datos provenientes del formulario y el item es un documento html que puede incluir imagenes,


## 1_ Los dos “medios huevos” de halfegg:

### 1.1 Descripción

El nombre “halfegg” (medio huevo) hace referencia a que el sistema se divide en dos partes, cada una de estas a la vez tiene una parte oculta en su interior.

Cada uno de los “medios huevos” se alojan en distintas urls, la parte del FRONT END está en el `http://dominio.com/index.php`, mientras que la parte BACK END se encuentra en otra url diferente, `http://dominio.com/intralog.php`

Uno sirve a las paginas de clientes/usuarios registrados y no registrados,  mientras que el otro sirve al panel de administracion y el formulario de registro de usuarios.

### 1.2 FRONT END: 

El sitio web en sí mismo, en donde la capa externa serían las páginas públicas. Y el núcleo interno solo accesible para los usuarios registrados, bloqueado para los usuarios no registrados.

### 1.3 BACK END:  

El sistema de registro de usuarios, es decir, la página de activación de cuenta. Esto representa la capa externa del medio huevo. Mientras que la parte oculta (amarilla) sería el panel de administración, desde donde el admin/webmaster puede crear las licencias y realizar otras operaciones reservadas solo para el administrador.

![This is an image](assets/images/halfegg-doc.png)

## 2_ Procedimiento de instalacion
Solicitar documento de instalacion y demo: https://digitalek.com/contacto/

## 2.1 Base de Datos

No es necesario crear una base de datos, el sistema lo hara automaticamente.

## Instalacion

Una vez se haya completado el procedimiento de instalacion, correr el instalador de base de datos simplemente accediendo a la URL del dominio. 
El instalador pedira una confirmacion. Asegurese de que el procedimiento de instalacion haya sido completado de forma correcta, de lo contrario se presentaran errores.

## 4.1_ Features

Sistema de LOGIN LOGOUT mediante variable de sesion
Sesion autostart crea datos y los inserta en la sesión 
sesion expiration
formulario de login
boton de logout
Valida nombre y contraseña con BBDD
formulario de registro con hash
Expiracion de enlace de registro
pagina de redirección si el usuario tiene cuenta activa
dashboard de admin
Instalador automatico de base de datos
Archivo env en carpeta no publica
CRUD en base de datos AJAX-JS
Bot Trap
Editar creacion del perfil de usuario
Formulario de Html TINYMCE



 






