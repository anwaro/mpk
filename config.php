<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://localhost/bazy/');
define('LIBS', 'libs/');
define('IMAGE_DIR', 'public/images');
define('FILE_DIR', 'public/files');

/*This is only for mysql connect in localhost*/
/*define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'projekt');
define('DB_USER', 'root');
define('DB_PASS', '');*/

/*This is only for mysql / pgsql connect in server*/
define('DB_TYPE', 'pgsql');
//define('DB_HOST', 'pascal');
define('DB_HOST', 'localhost');
//define('DB_NAME', 'pascal');
define('DB_NAME', 'u2mical');
define('DB_USER', 'u2mical');
define('DB_PASS', '2mical');

/*This is name of table in database*/
define("TABLE_PROJECTS", "projects");
define("TABLE_SONG", "song");
define("TABLE_ROOM", "rooms");


/*This is for sqlite connect*/
define('DB_NAME_SQLITE', 'database/projekt.db');


// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');