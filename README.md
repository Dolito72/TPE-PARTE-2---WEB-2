## TPE-PARTE-2 WEB-2
## API REST MOTOS ROYAL ENFIELD

### Introducción
Proyecto Trabajo Practico Especial - Parte 2,  creado para la materia Web 2 de la carrera Tecnicatura Universitaria en Desarrollo de Aplicaciones Informáticas (TUDAI)
de  la Universidad Nacional del Centro de la Pcia. de Bs. As. (UNICEN).  
El servicio lista productos (motos marca Royal Enfield) y permite consultar y buscar por filtros , paginar y ordenar por varios criterios.

### Autenticacion
Aun no cuenta con autenticación.

### API Métodos
Esta Api esta basada en principios RESTful y usa los métodos HTTP (GET) para acceder a los recursos, (POST y PUT) para agregar o modificar datos y (DELETE) para
eliminar. El formato de transferencia soportado por el API para enviar y recibir respuestas es en JSON.


  ### Request	      |     Método	   |             Endpoint	                    |       Status          


----------------------------------------------------------------------------------------------------        

  Obtener productos  |  GET          | http://localhost/web/tpe2/api/products/     |       200  

----------------------------------------------------------------------------------------------------

 Obtener producto    |    GET        | http://localhost/web/tpe2/api/products/:ID  |       200  

---------------------------------------------------------------------------------------------------

 Crear producto      |   POST        | http://localhost/web/tpe2/api/products/         |     201

 --------------------------------------------------------------------------------------------------

 Actualizar producto  |  PUT         |    http://localhost/web/tpe2/api/products/:ID   |      200

--------------------------------------------------------------------------------------------------
 
 Eliminar producto    |  DELETE      | http://localhost/web/tpe2/api/products/:ID       | 200 

--------------------------------------------------------------------------------------------------

_____________________________________________________________________________________________________________________________________________________

### Endpoints
Los endpoints en nuestra API permitirán acceder a los recursos para poder consultar, paginar, ordenar y filtrar datos de todos los productos registrados en la base
de datos db_motos de nuestra aplicación.

http://localhost/web/tpe2/api/products/

http://localhost/web/tpe2/api/products/:ID

## Recursos

### GET Lista de productos

http://localhost/web/tpe2/api/products/

Recurso del endpoint products/ que retorna una lista de productos. 

### GET Producto

http://localhost/web/tpe2/api/products/:ID

Recurso del endpoint products/ que retorna un producto.

### POST Crear un producto

http://localhost/web/tpe2/api/products/

Esta petición permite crear un nuevo producto y guardarlo en la base de datos.

Para enviarlo, usamos la salida en formato JSON, escribiéndolo en el body de la solicitud.
````
Ejemplo:
BODY
   {
        "precio": 1190,
        "color": "Stellar red",
        "stock": 4,
        "id_especificacion": 3
    }
````

### PUT Actualizar un producto

http://localhost/web/tpe2/api/products/:ID

Esta petición actualiza un producto que ya existe. Para ello vamos a necesitar el id del mismo.
Luego, en formato JSON, escribimos los datos en el body.
En el ejemplo a continuación, modificamos el precio del producto anterior que tiene el id 4.

http://localhost/web/tpe2/api/products/4

```
BODY
   {
        "precio": 1200,
        "color": "Stellar red",
        "stock": 4,
        "id_especificacion": 3
    }
````

### DELETE Eliminar un producto

http://localhost/web/tpe2/api/products/:ID

Esta petición elimina un producto. Para ello vamos a necesitar el id del mismo.
En formato JSON, escribimos los datos en el body.
En el ejemplo a continuación, eliminamos el producto con el id 4.

http://localhost/web/tpe2/api/products/:4

````
BODY
   {
        "precio": 1200,
        "color": "Stellar red",
        "stock": 4,
        "id_especificacion": 3
    }
````

### Parámetros por defecto

En el caso de que se omitan algunos parámetros de consulta, las solicitudes GET devolverán los valores por defecto establecidos.
Los mismos son página 1, límite 25, ordenados por id_especificación de forma ascendente.

## Paginación
Se podrán paginar los resultados si se agregan los parámetros de consulta limit y page a las solicitudes GET:
En el siguiente ejemplo, devuelve la página 1 con 5 productos:

http://localhost/web/tpe2/api/products/?page=1&limit=5

Nota: si omite el parámetro de pedido, la página predeterminada será 1 y el limite 25.

### Orden
Los resultados pueden estar ordenados si se agregan a la consulta los parámetros orderBy (columna por la que se ordena) y order(asc o desc) a las solicitudes GET:

http://localhost/web/tpe2/api/products/?sortBy=id_especificacion&order=desc

Nota: si omite el parámetro de pedido, el orden predeterminado será por la columna id_especificacion y asc.

### Filtrado
Los resultados pueden devolverse filtados por columna si se agregan parámetros de consulta column (campo por filtrar) y filtervalue(valor de la columna) a la solicitud GET.

En el ejemplo busca en todos los campos que tienen el id de especificacion 13:


http://localhost/web/tpe2/api/products/?column=id_especificacion&filtervalue=13

-------------------------------------------------------------------------------------------------------------------------------------------------------
## Errores
A continuación se detallan errores específicos de la API y los mensajes de respuesta a los mismos.

 ###  Status    |    Código error	       |                  Mensaje	  

     400       |    "Bad request"        |      "Ingresó de forma incorrecta el parámetro"                
-----------------------------------------------------------------------------------------------------
                                                                   
     404       |   "Not found"           |           "No hay productos"                             
---------------------------------------------------------------------------------------------------------  
 
     500       | "Internal Server Error"  | "Se encontró algo inesperado que impide completar la petición"


-----------------------------------------------------------------------------------------------------------

En el ejemplo se ingresa mal el parámetro para ordenar:

http://localhost/web/tpe2/api/products/?order=desc&page=1&limit=2&filtervalue=venturablue&orderBy=jdjdjdjd&column=color

"Ingresó de forma incorrecta el parámetro para ordenar"
