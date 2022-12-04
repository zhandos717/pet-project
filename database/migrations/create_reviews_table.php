<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table reviews(
                id      INTEGER PRIMARY KEY autoincrement,
                good_id INTEGER,
                user_id INTEGER NOT NULL,
                text    TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                );';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
