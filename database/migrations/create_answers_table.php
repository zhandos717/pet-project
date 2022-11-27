<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table answers(
                id          INTEGER primary key autoincrement,
                text        TEXT        not null,
                positive    INT,
                question_id varchar(10) not null
                );';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
