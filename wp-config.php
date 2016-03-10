<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'itwascool');

/** Имя пользователя MySQL */
define('DB_USER', 'test');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'test');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0(^$8H*}-^WM`=COmm^fZs)N8ld6dR$Fi[)-UP!:4EeN=K1c|[|qX=cMybZnRXjB');
define('SECURE_AUTH_KEY',  '|7F2KFZB8YVNC vptWF#+]>5]n8moD@Zp1iUvDDit-?>H{V*D^|od`c}`v1aRb=i');
define('LOGGED_IN_KEY',    'XWTvN?zjI!DuJ{Vj]g#t:y_XK!htDa]{VZtpvAB:ai]Em.8*+VZiy=dKaqv6tusx');
define('NONCE_KEY',        '94gD2k2FTB?oH@kipCoQ,iK=C{#((MQ8j4}B+s+_CjiX=e}BF~ZrH16;wzqZ^2Nq');
define('AUTH_SALT',        'Z8sP^2I|+be4-BH$;1?}=M* $F};PyWXDDPYTuLcPT8jz+egd;NlHyh$;MBBMF_Z');
define('SECURE_AUTH_SALT', 'D.EWac&1MD^!kp1ub*>(wo1F6,%+Y*30])u|T,!Iu|8|aK|R=D/mB%WNx@38QPXW');
define('LOGGED_IN_SALT',   'w9KtBvA-4_ <|x9{1Epe--wbZaolmqpz+$Dmj%l!bWWy@jEuCNE<) nw6X7-= -b');
define('NONCE_SALT',       '||i .H0-wjGudJO15>1*,!I!/WAI+H/3ZL%R>S;RnQn 1/-X2?{YzhH-KKE}iFb|');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
