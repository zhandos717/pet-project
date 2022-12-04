<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table users(
                id          INTEGER PRIMARY KEY autoincrement,
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                password varchar(255) NOT NULL,
                role_id INTEGER default 0
                );';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
