<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table results(
                id    INTEGER primary key autoincrement,
                data  TEXT not null,
                total INTEGER,
                uuid  varchar(255));';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
