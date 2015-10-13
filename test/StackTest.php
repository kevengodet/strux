<?php

use Aldente\Stack;

class StackTest extends PHPUnit_Framework_TestCase
{
    public function testPushAndPop()
    {
        $stack = new Stack();
        $this->assertEquals(0, count($stack));
        $this->assertEquals(true, $stack->isEmpty());

        $stack->push('foo');
        $this->assertEquals(1, count($stack));
        $this->assertEquals(false, $stack->isEmpty());
        $this->assertEquals(['foo'], $stack->toArray());
        $this->assertEquals('foo', $stack->pop());
        $this->assertEquals(0, count($stack));
        $this->assertEquals(true, $stack->isEmpty());
    }

    /**
     *
     * @dataProvider valuesProvider
     */
    public function testPushAll($values)
    {
        $stack = new Stack(['a', 'b', 'c']);
        $stack->pushAll($values);
        $this->assertEquals(['a', 'b', 'c', 'd', 'e'], $stack->toArray());
        $this->assertEquals(5, count($stack));
        $this->assertEquals('e', $stack->pop());
        $this->assertEquals('d', $stack->pop());
        $this->assertEquals('c', $stack->pop());
        $stack->clear();
        $this->assertEquals(0, count($stack));
        $this->assertEquals([], $stack->toArray());
    }

    public function valuesProvider()
    {
        return [
            'Push an array'       => [['d', 'e']],
            'Push an ArrayObject' => [new \ArrayObject(['d', 'e'])],
            'Push a Stack'        => [new Stack(['d', 'e'])],
        ];
    }
}
