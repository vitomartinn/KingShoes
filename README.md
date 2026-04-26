# 👟 King Shoes

Sistema web para administrar una tienda física de zapatillas. Podés ver los clientes, las sucursales, el catálogo de calzado y registrar órdenes de compra, todo desde el navegador sin complicaciones.

---

1. 🧰 ¿Con qué está hecho?

-  PHP: para toda la lógica del servidor
-  MySQL: como base de datos
-  HTML + CSS: para la interfaz
-  XAMPP: para correrlo en local (con Apache y phpMyAdmin)

---

2. 📂 ¿Qué hay en el proyecto?

```
KingShoes/
├── index.php           → Panel principal con los accesos a todo
├── clientes.php        → Lista de clientes registrados
├── calzado.php         → Catálogo con modelo, talle, precio y stock
├── compras.php         → Historial de órdenes de compra con cliente incluido
├── agregar_compra.php  → Formulario para cargar una nueva compra
├── tiendas.php         → Lista de sucursales con dirección y cliente asignado
├── conexion.php        → Conexión a la base de datos
├── estilos.css         → Los estilos de toda la página
└── king_shoes.sql      → El script para crear la base de datos desde cero
```

---

3. 🗃️ La base de datos

Tiene 4 tablas que se relacionan entre sí:

| Tabla             | ¿Para qué sirve?                                        |
|-------------------|---------------------------------------------------------|
| `clientes`        | Guarda el número y nombre de cada cliente               |
| `tienda`          | Las sucursales de King Shoes con su dirección           |
| `calzado`         | El catálogo: modelo, talle, precio y stock              |
| `orden_de_compra` | Registra cada compra con fecha, cliente, cantidad y total |

---

4. 🚀 ¿Cómo lo levanto?

Lo que necesitás tener instalado
- ✅ PHP 8.x
- ✅ MySQL 
- ✅ XAMPP (o cualquier servidor local similar)

5. 👤 Autores

Hecho por Vito Martin (https://github.com/vitomartinn), Thiago Montenegro y Ramiro Tatone
