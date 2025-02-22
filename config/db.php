<?php

return [
    'class' => 'yii\db\Connection',
    // у вас остается только закомментированная строка
    // 'dsn' => 'mysql:host=localhost;dbname=de',

    //только для osp6
    'dsn' => 'mysql:host=MariaDB-11.2;dbname=de',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
