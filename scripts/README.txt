Programas incluidos
-------------------
1. inventario.py
   Inventario de equipos de la empresa. Permite añadir equipos, borrarlos
   y guardar la lista en el archivo equipos.txt.

2. usuarios.py
   Gestión de usuarios y departamentos (SistemasIT, Desarrollo, Redes y
   Administracion). Permite crear, modificar y eliminar usuarios, y
   guardar el estado de los departamentos en el archivo usuarios.txt.

3. contragestor.py
   Generador de contraseñas seguras. Crea una contraseña aleatoria con
   letras, números y símbolos de la longitud que se indique.


Cómo ejecutarlos
----------------
- Tener Python 3 instalado.
- Abrir una terminal en la carpeta donde están los archivos.
- Escribir:  python nombre_del_programa.py
  (por ejemplo: python inventario.py)


Cómo se usan
------------
INVENTARIO (inventario.py)
- Escribe los datos de cada equipo con esta estructura:
  /PC: nombre /IP: dirección /ISO: sistema operativo
- BORRAR: muestra la lista numerada y pide la posición (empieza en 0)
  del equipo que se quiere eliminar.
- EXIT: guarda la lista en equipos.txt y cierra el programa.

USUARIOS (usuarios.py)
Menú con 5 opciones:
  1. Crear usuario: pide el nombre y el departamento (del 1 al 4).
     El cargo se asigna automáticamente según el departamento.
  2. Modificar usuario: permite cambiar su nombre o intercambiarlo de
     departamento con otro usuario.
  3. Eliminar usuario: lo quita de la lista y deja su departamento
     como VACIO.
  4. Mostrar listas: enseña los usuarios y el estado de cada departamento.
  5. Salir: guarda todo en usuarios.txt y cierra el programa.

GENERADOR DE CONTRASEÑAS (contragestor.py)
- Escribe cuántos caracteres quieres (por ejemplo, 12 o más).
- El programa muestra la contraseña generada por pantalla.
