<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table questions(
                id INTEGER primary key autoincrement,
                title varchar(255) not null
                );';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
