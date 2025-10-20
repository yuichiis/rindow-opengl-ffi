<?php
namespace Rindow\OpenGL\FFI;

use InvalidArgumentException;

interface OpenGL
{
    // glGetError
    const GL_NO_ERROR = 0;
    const GL_INVALID_ENUM = 0x0500;
    const GL_INVALID_VALUE = 0x0501;
    const GL_INVALID_OPERATION = 0x0502;
    const GL_OUT_OF_MEMORY = 0x0505;
    // glString Name
    const GL_VENDOR = 0x1F00;
    const GL_RENDERER = 0x1F01;
    const GL_VERSION = 0x1F02;
    const GL_EXTENSIONS = 0x1F03;
}
