<?php
namespace Rindow\OpenGL\FFI;

use Interop\Polite\Math\Matrix\OpenCL;
use InvalidArgumentException;
use RuntimeException;
use OutOfRangeException;
use FFI;
use Countable;

class OpenGLImpl
{
    protected FFI $ffi;

    public function __construct(FFI $ffi)
    {
        $this->ffi = $ffi;
    }

    public function __destruct()
    {
    }

}