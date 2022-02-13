PHP 7.3, MariaDB 10.5

1. composer i
2. php artisan key:generate
2. .env.example скопировать и переименовать в .env
3. В файле .env настроить соединение с БД
4. Выполнить команду в консоли php artisan migrate и php artisan db:seed 


**// это может занять некоторое время, будет посеяно около 20000 записей**


**// в файле DatabaseSeeder возможно уменьшить кол-во для более бысрого посева**


К сожалению я не разобрался с Laravel Swagger, поэтому предоставлю краткое описание API в этом файле

**Получение списка авторов**
/api/authors GET

Параметры:
- page (integer, необязательный) Пагинация
- last_name (string, необязательный) Фильтрация по фамилии

Ответ:
- 200 успешно найдено body: array
- 200 ничего не найдено body: empty array

**Получение списка категорий**
/api/categories GET

Параметры:
- page (integer, необязательный) Пагинация

Ответ:
- 200 успешно найдено body: array
- 200 ничего не найдено body: empty array

**Получение списка постов**
/api/posts GET

Параметры:
- page (integer, необязательный) Пагинация
- query (string, необязательный) Фильтрация по ФИО авторов/Названию категории/Названию поста

Ответ:
- 200 успешно найдено body: array
- 200 ничего не найдено body: empty array

**Получение автора по id или slug**
/api/author/{query} GET

Параметры:
- query (string/integer, обязательный прямо в строке URL) id или slug автора

Ответ:
- 200 успешно найдено body: object
- 200 ничего не найдено body: empty object

**Получение категории по id или slug**
/api/author/{query} GET

Параметры:
- query (string/integer, обязательный прямо в строке URL) id или slug категории

Ответ:
- 200 успешно найдено body: object
- 200 ничего не найдено body: empty object

**Получение поста по id или slug**
/api/author/{query} GET

Параметры:
- query (string/integer, обязательный прямо в строке URL) id или slug поста

Ответ:
- 200 успешно найдено body: object
- 200 ничего не найдено body: empty object
