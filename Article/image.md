Baseline JPEG 和 Progressive JPEG 区别
--------------------------

* Baseline JPEG
        这种类型的JPEG文件存储方式是按从上到下的扫描方式，把每一行顺序的保存在JPEG文件中。
        打开这个文件显示它的内容时，数据将按照存储时的顺序从上到下一行一行的被显示出来，直到所有的数据都被读完，就完成了整张图片的显示。
        如果文件较大或者网络下载速度较慢，那么就会看到图片被一行行加载的效果，这种格式的JPEG没有什么优点，因此，一般都推荐使用Progressive JPEG
* Progressive JPEG
        和Baseline一遍扫描不同，Progressive JPEG文件包含多次扫描，这些扫描顺寻的存储在JPEG文件中。
        打开文件过程中，会先显示整个图片的模糊轮廓，随着扫描次数的增加，图片变得越来越清晰。
        这种格式的主要优点是在网络较慢的情况下，可以看到图片的轮廓知道正在加载的图片大概是什么。
        在一些网站打开较大图片时，你就会注意到这种技术。

```
int imageinterlace ( resource $image [, int $interlace = 0 ] )
If the interlace bit is set and the image is used as a JPEG image, the image is created as a `progressive` JPEG.

($interlace) If non-zero, the image will be interlaced, else the interlace bit is turned off.
```