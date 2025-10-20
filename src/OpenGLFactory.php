<?php
namespace Rindow\OpenGL\FFI;

use FFI;
//use FFI\Env\Runtime as FFIEnvRuntime;
//use FFI\Env\Status as FFIEnvStatus;
//use FFI\Location\Locator as FFIEnvLocator;
use Interop\Polite\Math\Matrix\LinearBuffer as HostBuffer;
use FFI\Exception as FFIException;
use RuntimeException;

class OpenGLFactory
{
    const STAUTS_OK = 0;
    const STAUTS_LIBRARY_NOT_LOADED = -1;
    const STATUS_CONFIGURATION_NOT_COMPLETE = -2;
    const STATUS_DEVICE_NOT_FOUND = -3;
    
    private static ?FFI $ffi = null;
    private static ?string $statusMessage = null;
    private static int $status = 0;

    /** @var array<string> $libs_win */
    protected array $libs_win = ['opengl32.dll'];
    /** @var array<string> $libs_linux */
    protected array $libs_linux = ['libGL.so.1', 'libGL.so'];
    /** @var array<string> $libs_mac */
    protected array $libs_mac = [
        '../Frameworks/OpenGL.framework/OpenGL',
        '/Library/Frameworks/OpenGL.framework/OpenGL',
        '/System/Library/Frameworks/OpenGL.framework/OpenGL',
        '/System/Library/Frameworks/OpenGL.framework/Versions/Current/OpenGL',
    ];

    /**
     * @param array<string> $libFiles
     */
    public function __construct(
        ?string $headerFile=null,
        ?array $libFiles=null,
        )
    {
        if(self::$ffi!==null) {
            return;
        }
        if(!extension_loaded('ffi')) {
            return;
        }
        $headerFile = $headerFile ?? __DIR__ . "/opengl.h";
        if($libFiles==null) {
            if(PHP_OS=='Linux') {
                $libFiles = $this->libs_linux;
            } elseif(PHP_OS=='WINNT') {
                $libFiles = $this->libs_win;
            } elseif(PHP_OS=='Darwin') {
                $libFiles = $this->libs_mac;
            } else {
                throw new RuntimeException('Unknown operating system: "'.PHP_OS.'"');
            }
        }
        $code = file_get_contents($headerFile);
        foreach ($libFiles as $filename) {
            try {
                $ffi = FFI::cdef($code,$filename);
            } catch(FFIException $e) {
                if(self::$status>self::STAUTS_LIBRARY_NOT_LOADED) {
                    self::$statusMessage = 'OpenGL library not loaded.';
                }
                continue;
            }
            self::$ffi = $ffi;
            self::$status = self::STAUTS_OK;
            break;
        }
    }

    public function getStatus() : int
    {
        return self::$status;
    }

    public function getStatusMessage() : string
    {
        return self::$statusMessage??'';
    }

    public function isAvailable() : bool
    {
        return self::$ffi!==null;
    }

    public function OpenGL() : mixed
    {
        if(self::$ffi==null) {
            throw new RuntimeException($this->getStatusMessage());
        }
        return self::$ffi;
    }

}
