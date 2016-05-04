<?php namespace Rollbar;

use \Mockery as m;
use Rollbar\Payload\Frame;

class FrameTest extends \PHPUnit_Framework_TestCase
{
    private $exception;
    private $frame;

    public function setUp()
    {
        $this->exception = m::mock("Rollbar\Payload\ExceptionInfo");
        $this->frame = new Frame("tests/FrameTest.php", $this->exception);
    }

    public function testFilename()
    {
        $frame = new Frame("filename.php");
        $this->assertEquals("filename.php", $frame->getFilename());
        $frame->setFilename("other.php");
        $this->assertEquals("other.php", $frame->getFilename());
    }

    public function testLineno()
    {
        $this->frame->setLineno(5);
        $this->assertEquals(5, $this->frame->getLineno());
    }

    public function testColno()
    {
        $this->frame->setColno(5);
        $this->assertEquals(5, $this->frame->getColno());
    }

    public function testMethod()
    {
        $this->frame->setMethod("method");
        $this->assertEquals("method", $this->frame->getMethod());
    }

    public function testCode()
    {
        $this->frame->setCode("code->whatever()");
        $this->assertEquals("code->whatever()", $this->frame->getCode());
    }

    public function testContext()
    {
        $context = m::mock("Rollbar\Payload\Context");
        $this->frame->setContext($context);
        $this->assertEquals($context, $this->frame->getContext());
    }

    public function testArgs()
    {
        $this->frame->setArgs(array());
        $this->assertEquals(array(), $this->frame->getArgs());

        $this->frame->setArgs(array(1, "hi"));
        $this->assertEquals(array(1, "hi"), $this->frame->getArgs());
    }

    public function testKwargs()
    {
        $this->frame->setKwargs(array("hi" => "bye"));
        $this->assertEquals(array("hi" => "bye"), $this->frame->getKwargs());
    }

    public function testEncode()
    {
        
    }
}
