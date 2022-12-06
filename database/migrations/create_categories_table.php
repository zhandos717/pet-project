<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table categories(
                id   INTEGER PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL
                );';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
