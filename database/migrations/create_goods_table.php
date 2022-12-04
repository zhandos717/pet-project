<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table goods(
                id          INTEGER PRIMARY KEY autoincrement,
                title varchar(255) NOT NULL,
                description  TEXT not null,
                images  TEXT null,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                );';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
