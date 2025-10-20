<?php
namespace RindowTest\OpenGL\FFI\OpenGLFactoryTest;

use PHPUnit\Framework\TestCase;
use Interop\Polite\Math\Matrix\NDArray;
use Rindow\Math\Buffer\FFI\BufferFactory;
use Rindow\OpenGL\FFI\OpenGLFactory;
use Rindow\OpenGL\FFI\OpenGL;

define('GL_VERSION', 0x1F02); 

use RuntimeException;

class OpenGLFactoryTest extends TestCase
{
    public function newDriverFactory()
    {
        $factory = new OpenGLFactory();
        return $factory;
    }

    public function testPlatformList()
    {
        $factory = $this->newDriverFactory();
        $gl = $factory->OpenGL();
        $version = $gl->glGetString(GL_VERSION);
        var_dump($version);

        $errno = $gl->glGetError();
        var_dump($errno);
        echo dechex($errno)."\n";
    }

}
