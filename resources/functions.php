<?php

/**
 * Редактируйте этот файл только если уверены в том, что делаете
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Вспомогательная функция для более читабельного отображения ошибок
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Убедиться, что используется совместимая версия PHP
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('Вы должны использовать PHP версии 7.1 или выше.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Убедиться, что используется совместимая версия WordPress
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('Вы должны использовать WordPress версии 4.7.0 или выше.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Убедиться, что все зависимости установлены
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('Вы должны запустить <code>composer install</code> из директории темы.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Файлы Sage
 *
 * Подключает файлы из директории App по списку из массива.
 * Список можно редактировать. Поддерживает переопределение дочерней темой.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Что здесь происходит:
 * 1. WordPress находит тему в директории themes/sage/resources
 * 2. При активации мы сообщаем WordPress, что файлы темы находятся в themes/sage/resources/views
 * 3. При вызове get_template_directory() или get_template_directory_uri() мы переадресуем их назад в themes/sage/resources
 *
 * Мы делаем это, чтобы иерархия шаблонов проверяла директорию views на наличие соответствующих шаблонов,
 * но при этом functions.php, style.css, и index.php находились бы в директории resources.
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);
