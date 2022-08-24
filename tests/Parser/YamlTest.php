<?php

namespace Noodlehaus\Parser\Test;

use Noodlehaus\Parser\Yaml;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-21 at 22:37:22.
 */
class YamlTest extends TestCase
{
    /**
     * @var Yaml
     */
    protected $yaml;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->yaml = new Yaml();
    }

    /**
     * @covers Noodlehaus\Parser\Yaml::getSupportedExtensions()
     */
    public function testGetSupportedExtensions()
    {
        $expected = ['yaml', 'yml'];
        $actual   = $this->yaml->getSupportedExtensions();
        $this->assertSame($expected, $actual);
    }

    /**
     * @covers                   Noodlehaus\Parser\Yaml::parseFile()
     * @covers                   Noodlehaus\Parser\Yaml::parse()
     */
    public function testLoadInvalidYamlFile()
    {
        $this->expectException(\Noodlehaus\Exception\ParseException::class);
        $this->expectExceptionMessage('Error parsing YAML file');
        $this->yaml->parseFile(__DIR__ . '/../mocks/fail/error.yaml');
    }

    /**
     * @covers                   Noodlehaus\Parser\Yaml::parseString()
     * @covers                   Noodlehaus\Parser\Yaml::parse()
     */
    public function testLoadInvalidYamlString()
    {
        $this->expectException(\Noodlehaus\Exception\ParseException::class);
        $this->expectExceptionMessage('Error parsing YAML string');
        $this->yaml->parseString(file_get_contents(__DIR__ . '/../mocks/fail/error.yaml'));
    }

    /**
     * @covers Noodlehaus\Parser\Yaml::parseFile()
     * @covers Noodlehaus\Parser\Yaml::parse()
     */
    public function testLoadYaml()
    {
        $actual = $this->yaml->parseFile(__DIR__ . '/../mocks/pass/config.yaml');
        $this->assertSame('localhost', $actual['host']);
        $this->assertSame(80, $actual['port']);
    }

    /**
     * @covers Noodlehaus\Parser\Yaml::parse()
     */
    public function testLoadYml()
    {
        $actual = $this->yaml->parseFile(__DIR__ . '/../mocks/pass/config.yml');
        $this->assertSame('localhost', $actual['host']);
        $this->assertSame(80, $actual['port']);
    }

    /**
     * @covers Noodlehaus\Parser\Yaml::parseString()
     */
    public function testLoadYamlString()
    {
        $actual = $this->yaml->parseString(file_get_contents(__DIR__ . '/../mocks/pass/config.yaml'));
        $this->assertSame('localhost', $actual['host']);
        $this->assertSame(80, $actual['port']);
    }
}
