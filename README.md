# [Sage](https://roots.io/sage/)

Sage - это тема WordPress, использующая современные средства разработки.

## Преимущества

* Sass для препроцессинга стилей
* Современный JavaScript
* [Webpack](https://webpack.github.io/) для сборки статики, оптимизации изображений, конкатенации и минификации файлов
* [Browsersync](http://www.browsersync.io/) для синхронизации с браузером в реальном времени
* [Blade](https://laravel.com/docs/5.5/blade) в качестве шаблонизатора
* [Controller](https://github.com/soberwp/controller) для передачи данных в шаблоны Blade
* CSS-фреймворки (опционально): [Bootstrap 4](https://getbootstrap.com/), [Bulma](https://bulma.io/), [Foundation](https://foundation.zurb.com/), [Tachyons](http://tachyons.io/)

Рабочий пример: [roots-example-project.com](https://roots-example-project.com/)

## Требования

Перед началом работы убедитесь, что все зависимости установлены:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](https://secure.php.net/manual/en/install.php) >= 7.1.3 (с включенным модулем [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php))
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)

## Структура файлов

```shell
themes/your-theme-name/   # → Корневая директория темы
├── app/                  # → PHP темы
│   ├── controllers/      # → Файлы контроллеров
│   ├── admin.php         # → Конфигурация customizer'а
│   ├── filters.php       # → Фильтры темы
│   ├── helpers.php       # → Вспомогательные функции
│   └── setup.php         # → Основная конфигурация темы
├── composer.json         # → Автозагрузка для файлов из `app/`
├── composer.lock         # → Lock-файл Composer'а (не редактировать вручную)
├── dist/                 # → Собранная статика темы (не редактировать вручную)
├── node_modules/         # → Node.js-пакеты (не редактировать вручную)
├── package.json          # → Node.js-зависимости и скрипты
├── resources/            # → Статика и шаблоны темы
│   ├── assets/           # → Статика для фронтенда
│   │   ├── config.json   # → Конфигурация сборки статики
│   │   ├── build/        # → Конфигурация Webpack и ESLint
│   │   ├── fonts/        # → Шрифты
│   │   ├── images/       # → Изображения
│   │   ├── scripts/      # → JS
│   │   └── styles/       # → Стили
│   ├── functions.php     # → Автозагрузка Composer, зависимости темы
│   ├── index.php         # → Не редактировать вручную
│   ├── screenshot.png    # → Скриншот темы для панели администратора
│   ├── style.css         # → Информация о теме
│   └── views/            # → Файлы шаблонов
│       ├── layouts/      # → Базовые шаблоны
│       └── partials/     # → Включаемые части шаблонов
└── vendor/               # → Пакеты Composer (не редактировать вручную)
```

## Конфигурация темы

Отредактируйте `app/setup.php`, чтобы включить или отключить функционал темы, настроить меню, сайдбары, размеры изображений.

## Разработка темы

* Запустите `yarn` из директории темы, чтобы установить зависимости
* Отредактируйте настройки в `resources/assets/config.json`:
  * `devUrl` должен отражать ваш локальный домен для разработки
  * `publicPath` должен отражать вашу структуру директорий WordPress (`/wp-content/themes/sage` если не используется [Bedrock](https://roots.io/bedrock/))

### Команды для сборки

* `yarn start` — Следить за изменениями файлов и компилировать статику, начать сессию Browsersync 
* `yarn build` — Скомпилировать и оптимизировать статику
* `yarn build:production` — Скомпилировать статику для production

## Документация

* [Документация Sage](https://roots.io/sage/docs/)
* [Документация Controller'а](https://github.com/soberwp/controller#usage)
