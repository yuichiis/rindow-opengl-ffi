#define FFI_SCOPE "Rindow\\OpenGL\\FFI"
//#define FFI_LIB "OpenCL.DLL"

/////////////////////////////////////////////
typedef int8_t                      cl_char;
typedef uint8_t                     cl_uchar;
typedef int16_t                     cl_short;
typedef uint16_t                    cl_ushort;
typedef int32_t                     cl_int;
typedef uint32_t                    cl_uint;
typedef int64_t                     cl_long;
typedef uint64_t                    cl_ulong;
typedef uint16_t                    cl_half;

typedef float                       cl_float;
typedef double                      cl_double;

extern const uint32_t glGetError(void);
extern const char* glGetString(uint32_t name);
