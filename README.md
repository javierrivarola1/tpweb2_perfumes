# WEB-II-Trabajo-Práctico - Ecommerce Perfumes.
Proyecto creado para la cátedra de Web2, Facultad UNICEN, carrera TUDAI.

## 📋 Numero de grupo: 
48

## 📋 Nombres de los integrantes del grupo: 
<ul>
<li><strong> Javier Ignacio Rivarola - nachovisa1@gmail.com </strong></li>
<li><strong> Micaela Jazmín Breijo - micabreijo@gmail.com </strong></li>
</ul>

## 🧠 Tematica:
Ecommerce especializado en perfumes de nicho y marcas reconocidas, orientado a ofrecer experiencias olfativas únicas para todos los géneros: masculinos, femeninos y unisex.

## ✅ Diagrama de entidad relación (DER)
Las entidades principales de la base de datos son productos y marcas . Para cada una se construyó una tabla con sus respectivos atributos.

<ul>
<li><strong>Tabla productos</strong>: Contiene información sobre las caracteristicas de los perfumes.</li>
<li><strong>Tabla marca</strong>: Almacena información sobre la marca de los perfumes.</li>
</ul>
  
La relación entre estas tablas es de 1 a N , lo que significa que una marca puede tener más de un perfume, pero un perfume sólo puede pertenecer a una marca específica.

## ✅ Acceso Administrador

<ul>
<li><strong>Autenticación</strong>: Los administradores deben loguearse para acceder a las funcionalidades de administración de datos.</li>
<li><strong>Actividades de la Adminitracion</strong>:Los administradores pueden agregar, editar y eliminar marcas y productos.</li>
<li><strong>Cerrar Sesión</strong>:Los administradores pueden desloguearse del sistema.</li>
</ul>

## ✅ Requisitos tecnicos

<ul>
<li>El sistema está basado en el patrón MVC para separar la lógica del negocio, las vistas y el acceso a los datos.</li>
<li>Las vistas se generan utilizando plantillas PHTML.</li>
<li>El sitio utiliza URL semánticas.</li>
</ul>

## ✅ Manual de uso. Carga de productos y marcas
Una vez logueado, el administrador podra agregar tanto marcas como productos nuevos, siendo en el caso de los productos el rango minimo para la presentacion de 20 ml, por lo cual el entero a colocar debera ser un numero mayor o igual a 20.



<img width="952" height="607" alt="Captura de pantalla 2025-09-23 194921" src="https://github.com/user-attachments/assets/a92a6dfe-b1f6-4c09-af7d-914411362a8e" />









