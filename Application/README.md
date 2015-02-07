在命令行执行:php -dvld.active=1 -dvld.execute=0 test.php
=============
```
得到下边的结果:

Finding entry points
Branch analysis from position: 0
Return found
filename:       F:\home\projects\lijingtest\innercode\test.php
function name:  (null)
number of ops:  5
compiled vars:  !0 = $a
line     # *  op                           fetch          ext  return  operands
-------------------------------------------------------------------------------
   2     0  >   ASSIGN                                                   !0, 1
   3     1      ECHO                                                     !0
   4     2      ADD                                              ~1      !0, 1
         3      ECHO                                                     ~1
   6     4    > RETURN                                                   1
```