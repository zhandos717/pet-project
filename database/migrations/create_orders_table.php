<?php

declare(strict_types=1);

namespace database\migrations;

use App\Contract\Migration;

return new class implements Migration {

    public function up(): string
    {
        return 'create table orders(
                id INTEGER PRIMARY KEY AUTO_INCREMENT,
                name varchar(255),
                phone varchar(255) ,
                address varchar(255) 
                );';
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
};
