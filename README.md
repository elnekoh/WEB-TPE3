## Endpoints:

|  | VERBO | URL |
| --- | --- | --- |
| Listar todos las reseñas | GET | /reviews |
| Listar ordenado por columna a elección | GET | /reviews?OrderBy=:COLUMNA&Order=:ASC/DESC |
| Muestra una reseña determinada por su id | GET | /reviews/:ID |
| Inserta una reseña | POST | /reviews |
| Modifica una reseña con determinado id | PUT | /reviews/:ID |
| Obtiene token | GET | /user/token |

Esta api se conecta a una base de datos diseñada de la siguiente manera:

![bd diagram](https://github.com/user-attachments/assets/b472d60a-0581-492c-bd57-e73f7eaec68b)


La api esta diseñada para interactuar principalmente con la tabla “reviews” (reseñas).

La idea es que todos los usuarios puedan a travez de filtrados listar las reseñas, o ver una en particular. Solo pueden insertar filas o modificarlas los usuarios de rol “admin”

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
    - inserta una fila. No es necesario ingresar comentario o id_usuario (una reseña sin user es una reseña anonima o de invitado), si o si debe tener una puntuacion y un id_pelicula.
    - La api no esta pensada para que un usuario regular ingrese reseñas por medio de la api, por eso se toma la libertad de poder modificar o ingresar filas a nombre de otros usuarios, se asume que solo admins pueden hacerlo.
    - el jwt se autentifica por “bearer”
- /reviews/:ID (PUT) (necesita jwt)
    - Permite modificar una fila, los parametros obligatorios son los mismo que se usa para insertar, ademas se debe proporcionar el id de la pelicula a modificar en el endpoint.
    - el jwt se autentifica por “bearer”
    - ej: /reviews/3
- /user/token
    - otorga un jwt valido por 1hs
    - es necesario autenticarse mediante “basic”.
    - usuario de ejemplo:
        - usuario: “webadmin”
        - contraseña: “admin”
