Task Manager
=================

Prototypu prostego systemu do zarządzania zadaniami

Opis
-------

Listy zadań:

- Zadania są podzielone na dwie części: niewykonane zadania i wykonane zadania.
- Lista niewykonanych zadań posortowana jest według daty utworzenia zadania rosnąco (od najstarszych)
- Lista wykonanych zadań posortowana jest według daty wykonania zadania malejąco (najpierw ostatnio wykonane).
- Wykonane zadania mają przekreślone tytuły (strikethrough).

--------------------
Tworzenie zadań:
- Nad listą zadań jest prosty formularz tworzenia zadania uruchamiany przyciskiem `plus` - po wypełnieniu pola z tytułem oraz kliknięciem przycisk zapisz, zadanie jest zapisywane (jako niewykonane).

-------------------

Edycja tytułu zadania:
- Kliknięcie na tytuł powoduje zamianę tekstu na pole tekstowe i możliwość edycji (tylko dla zadań niewykonanych). Po wyjściu z pola tekstowego tytuł jes zapisywany.

-------------------

Zmiana statusu zadania:
- Zadania niewykonane można ozanczyć jako wykonane klikając na przycisk `done`.
- Dla zadania wykonanego można cofnąć status wykonania klikając na przycisk `cancel`.


Uruchamianie środowiska
---------------

- docker-compose up -d
- docker exec -ti apptask-web bash -c "composer install && cp .env.example .env"
- docker exec -ti apptask-web bash -c "chown -R www-data:www-data /var/www/html/storage && php artisan storage:link"
- docker exec -ti apptask-web bash -c "npm install && npm run build"
- docker exec -ti apptask-web bash -c "php artisan migrate --force && php artisan db:seed"

`Aplikacja będzie dostępny pod adresem http://localhost:8008/ dane do logowania admin@example.com/password  `

Wymagania
----------

* Git
* Docker
