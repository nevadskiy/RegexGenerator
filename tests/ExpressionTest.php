<?php

class ExpressionTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    function it_finds_a_string()
    {
        $regex = Expression::make()->find('www');
        $this->assertRegExp($regex, 'www');

        $regex = Expression::make()->then('www');
        $this->assertRegExp($regex, 'www');
    }

    /** @test */
    function it_checks_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertRegExp($regex, 'foo');
        $this->assertTrue($regex->test('foo'));
    }

    /** @test */
    function it_maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('http');

        $this->assertRegExp($regex, 'http');
        $this->assertRegExp($regex, 'foo');
    }

    /** @test */
    function it_can_chain_methods_calls()
    {
        $regex = Expression::make()->find('foo')->maybe('bar')->then('biz');

        $this->assertTrue($regex->test('foobarbiz'));
        $this->assertTrue($regex->test('foobiz'));
    }

    /** @test */
    function it_can_escape_strings()
    {
        $regex = Expression::make()->find('www')->maybe('.')->then('com');

        $this->assertTrue($regex->test('www.com'));
        $this->assertFalse($regex->test('wwwXcom'));
    }

    /** @test */
    function it_can_exclude_values()
    {
        $regex = Expression::make()
            ->find('foo')
            ->exclude('bar')
            ->then('biz');

        $this->assertTrue($regex->test('foobazbiz'));
        $this->assertFalse($regex->test('foobarbiz'));
    }
}