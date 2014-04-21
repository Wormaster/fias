FIAS
================

Осуществляет загрузку и обновление базы адресов из ФИАС.

Зависимости, помимо указанных в composer:
1. rar
2. unrar


Для инициализации необходимо запустить init.php. Поддерживаются 3 режима работы:

1. ```php init.php``` — запросит с сайта ФИАСа последнюю версию базы, скачает ее, распакует и импортирует.

2. ```php init.php /path/to/archive.rar``` — распакует и импортирует архив.

3. ```php init.php /path/to/fias_directory``` — импортирует уже распакованный архив.

Работа с API:
1. Дополнение адреса.
Запрос:
```fias.loc/api/complete/?pattern=Москва, Невск&limit=20``` — автодополнение с лимитом в двадцать записей.
Максимальное количество записей — 50. Если лимит не указан выдается максимальное количество.
Также можно указать параметры:
```max_depth``` -- максимальная глубина до которой будут искаться соответствия в адресной базе ФИАС.
```address_levels``` -- массив, уровень записей (по ФИАС) которые будут искаться.
Доступные наименования уровней:
*   region -- Регион (Санкт-Петербург, Московская область и т.д.)
*   area -- округ
*   area_district -- район округа/региона
*   city -- город
*   city_district -- район города
*   settlement -- населенный пункт
*   street -- улица
*   territory дополнительная территория
*   sub_territory -- часть дополнительной территории

```regions``` -- массив, с номерами регионов, по которым будет осуществлятся автодополнение.

Ответ:
```
{
    "items" : [
        {"is_complete":false, "title": "Москва, Невский пр.", "type": "address"},
        {"is_complete":false, "title": "Москва, Невское урочище", "type": "address"},
        {"is_complete":false, "title": "Невский вокзал", "type": "place"}
    ]
}
```

2. Валидация элемента.
Запрос:
```fias.loc/api/validate/?title=Москва, Невский пр.```
Ответ:
```
{
    "is_valid": true,
    "is_complete": false,
    "item_type": "address"
}
```
Параметр ```is_complete``` равен true если адрес полный (вместе с домом) и false в любом другом случае.
Параметр ```item_type``` может принимать три значения: null, если ничего не найдено, ```address``` если текст найден в ФИАС, ```place```, если текст- найден в списке places (аэропорты, вокзалы, порты и т.д.).


3. Получение адреса по индексу.
Запрос:
```fias.loc/api/convert/?address=```

4. Индекс по адресу.
```fias.loc/api/convert/?postal_code=```
