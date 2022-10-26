<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class HookdeckTest extends TestCase
{

    public function testGetForms()
    {
        $hookdeck = new \Skyfiber\Models\Hookdeck();
        $this->assertEquals(['Cancellation','Support','FiberSales'], $hookdeck->getForms());
    }

}
