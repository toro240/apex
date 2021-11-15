<?php

namespace Tests\Unit\Utils;

use App\Utils\SQLUtils;
use PHPUnit\Framework\TestCase;

class SQLUtilsTest extends TestCase
{
    /**
     * SQLUtils::escapeLike
     * @return void
     */
    public function testEscapeLike()
    {
        $actual = SQLUtils::escapeLike("\%%_テスト%");
        $this->assertEquals('\\\\\%\%\_テスト\%', $actual);
    }
}
