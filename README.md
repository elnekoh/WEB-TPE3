## Endpoints:

|  | VERBO | URL |
| --- | --- | --- |
| Listar todos las reseñas | GET | /reviews |
| Listar ordenado por columna a elección | GET | /reviews?orderBy=:COLUMNA&order=:ASC/DESC |
| Muestra una reseña determinada por su id | GET | /reviews/:ID |
| Inserta una reseña | POST | /reviews |
| Modifica una reseña con determinado id | PUT | /reviews/:ID |
| Obtiene token | GET | /user/token |

## Uso de POST/PUT:

Para poder crear o modificar una reseña con POST/PUT, es necesario usar un JWT, usando el método de autenticación “Bearer token”.

Los campos que son estrictamente necesarios son id_pelicula, y puntuacion, “comentario” no es necesario ya que puede ser null, y el id_usuario no se toma del body, se toma del JWT o de la reseña original en el caso de PUT.

A continuación, un ejemplo de un body para crear una reseña:
```json
{
  "id_pelicula": 1,
  "comentario": "Lorem ipsum",
  "puntuacion": 3
}
```

Esta api se conecta a una base de datos diseñada de la siguiente manera:

![bd diagram](https://github.com/user-attachments/assets/b472d60a-0581-492c-bd57-e73f7eaec68b)

## Introducción.
La api esta diseñada para interactuar principalmente con la tabla “reviews” (reseñas).

Se puede obtener un listado de todos elementos de la tabla "reseña" (GET), ver una reseña en particular especificandola por su ID (GET).
Si el usuario tiene un token de autenticación puede crear (POST) y modificar (PUT) reseñas, el usuario solo puede modificar reseñas creadas por el mismo.
Si el usuario tiene el rol "admin" puede modificar reseñas que no son suyas.

### Endpoints (en profundidad)

- /reviews (GET)
    - Lista todas las reviews
    - Query params:
        - orderBy: ordena las reseñas por la columna que se le pase.
            - id
            - id_pelicula
            - id_usuario
            - comentario
            - puntuacion
            - ej: /reviews?orderBy=puntuacion
        - order: permite elegir si se devuelve las reseñas en orden ascendente o decendente.
            - ASC
            - DESC
            - ej: /reviews?orderBy=puntuacion&order=DESC
- /reviews/:ID (GET)
    - Muestra una reseña con un determinado id
    - ej: /reviews/2
- /reviews (POST) (necesita jwt)
    - inserta una fila. No es necesario ingresar comentario, si o si debe tener una puntuacion y un id_pelicula, y el id_usuario se obtiene del jwt, no del body.
    - el jwt se autentifica por “bearer token”
- /reviews/:ID (PUT) (necesita jwt)
    - Permite modificar una fila, los parametros obligatorios son los mismo que se usa para insertar, ademas se debe proporcionar el id de la pelicula a modificar en el endpoint.
    - un usuario que no tiene rol "admin" solo puede editar reseñas editadas por el mismo, un usuario con rol "admin" puede editar cualquier reseña.
    - el jwt se autentifica por “bearer token”
    - ej: /reviews/3
- /user/token
    - otorga un jwt valido por 1hs.
    - es necesario autenticarse mediante “basic”.
    - usuario de ejemplo:
        - usuario: “webadmin”
        - contraseña: “admin”
