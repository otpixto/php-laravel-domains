# Тестовое задание

*Что сделано:* 
1. Добавлена миграция 2025_04_08_184321_create_domain_restriction_rules_table.php
2. Добавлен сид DomainRestrictionsRulesSeeder.php для заполнения таблицы
domain_restriction_rules
3. Добавлен DomainRestrictionMiddleware.php, который отсеивает запросы, в которых присутствуют параметры из таблицы domain_restriction_rules
4. Добалены тесты DomainRestrictionTest.php


*Как проверять:* 
1. Запустить миграцию и сид
2. Зайти на http://localhost/fallback из браузера Chrome(доступ запрещен) и другого браузера(доступ разрешен). Если используется не localhost, то нужно прописать свой домен в domains и поменять domain_id в domain_restriction_rules
3. Запустить DomainRestrictionTest.php

## Второстепенные задачи

- Разобраться почему не проходит```tests/Feature/Api/DomainUpdateTest```

  *Ответ:*
  Тест падает с 403 ошибкой, потому что authorizeResource проверяет права через политику, но DomainPolicy, но она не вызывается, нужно использовать метод authorize()

- Описать в каких случаях ```tests/Unit/FakerTest```  будет завершаться с ошибкой.

  *Ответ:*
  Тест использует $this->faker->unique()->word()
  Faker имеет ограниченный набор уникальных слов
  При $count = 90 тест может упасть, если в текущей локали Faker недостаточно уникальных слов или процессе выполнения было сгенерировано слишком много уникальных слов в других тестах. Например: $this->faker->locale('ru_RU') может иметь меньше слов, чем английская
  В редких случаях возможно совпадение "уникальных" слов.

