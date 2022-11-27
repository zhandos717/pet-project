<?php

declare(strict_types=1);

namespace App\Contract;

interface Migration
{
    public function up();

    public function down();
}
