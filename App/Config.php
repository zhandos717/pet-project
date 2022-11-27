<?php
declare(strict_types=1);

namespace App;


final class Config
{
    public const DATA_BASE_PATH = ROOT_PATH . '/database/';

    public const PATH_MIGRATIONS = ROOT_PATH . '/database/migrations/';

    public const PATH_TO_SQLITE_FILE = self::DATA_BASE_PATH . 'database.sqlite';
}
