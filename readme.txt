Задание: https://gist.github.com/MichaelDomo/8db2f09c8bd61f4a2f32fa38e444c9ed

Решение:
Классы приведенные в задании нарушают принципы SOLID и инкапсуляцию, поэтому в своем решении я избавился от наследования
в пользу композиции. Получилось три класса (DataProvider, DataManager, DataManagerCacheDecorator), каждый из которых
делает только одну задачу. Также я добавил абстракцию в виде двух интерфейсов (DataManagerInterface, DataProviderInterface),
чтобы решение не было привязано к конкретной реализации.

Дополнительные фиксы:
1. Не происходило сохранение в кэш - добавил $this->cache->save($cachedItem);
2. Создавался длинный ключ для кэша - исправил md5(json_encode($params));
3. Записывались неинформативные сообщения по ошибкам - исправил $this->logger->critical($e->getMessage(), $params).
