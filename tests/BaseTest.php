<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class BaseTest extends TestCase
{

    private \Skyfiber\Models\Base $base;

    protected function setUp(): void
    {
        $this->base = new \Skyfiber\Models\Base(
            [
                'id' => '1',
                'form_id' => '1',
                'date_created' => '2022',
                'ip' => '123',
                'source_url' => 'domain.com',
                'user_agent' => 'mozilla',
                'name' => 'chris',
                'company' => 'git'
            ]
        );
    }


    public function testClassArgsSetOnConstructor(): void
    {
        $this->assertObjectHasAttribute('id', $this->base);
        $this->assertObjectHasAttribute('form_id', $this->base);
        $this->assertObjectHasAttribute('date_created', $this->base);
        $this->assertObjectHasAttribute('ip', $this->base);
        $this->assertObjectHasAttribute('source_url', $this->base);
        $this->assertObjectHasAttribute('user_agent', $this->base);
        $this->assertObjectHasAttribute('name', $this->base);
        $this->assertObjectHasAttribute('company', $this->base);
        $this->assertEquals('1', $this->base->id);
        $this->assertEquals('1', $this->base->form_id);
        $this->assertEquals('2022', $this->base->date_created);
        $this->assertEquals('123', $this->base->ip);
        $this->assertEquals('domain.com', $this->base->source_url);
        $this->assertEquals('mozilla', $this->base->user_agent);
        $this->assertEquals('chris', $this->base->name);
        $this->assertEquals('git', $this->base->company);
    }

    public function testGetName()
    {
        $base = new \Skyfiber\Models\Base(['name' => 'John']);
        $baseWithCompany = new \Skyfiber\Models\Base(['name' => 'John', 'company' => 'Test']);

        $this->assertEquals('John', $base->getName());
        $this->assertEquals('John (Test)', $baseWithCompany->getName());
    }

    public function testToString()
    {
        $this->assertEquals(
            'Id: 1<br/>Form Id: 1<br/>Date Created: 2022<br/>Ip: 123<br/>Source Url: domain.com<br/>User Agent: mozilla<br/>Name: chris<br/>Company: git<br/>',
            (string)$this->base
        );
    }

    public function testAttributesReturnsArray()
    {
        $this->assertIsArray($this->base->attributes());
    }

    public function testGetSubject()
    {
        $this->assertEquals('SkyFiber Base - chris (git)', $this->base->getSubject());
    }
}
