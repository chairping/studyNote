Baseline JPEG �� Progressive JPEG ����
--------------------------

* Baseline JPEG
        �������͵�JPEG�ļ��洢��ʽ�ǰ����ϵ��µ�ɨ�跽ʽ����ÿһ��˳��ı�����JPEG�ļ��С�
        ������ļ���ʾ��������ʱ�����ݽ����մ洢ʱ��˳����ϵ���һ��һ�еı���ʾ������ֱ�����е����ݶ������꣬�����������ͼƬ����ʾ��
        ����ļ��ϴ�������������ٶȽ�������ô�ͻῴ��ͼƬ��һ���м��ص�Ч�������ָ�ʽ��JPEGû��ʲô�ŵ㣬��ˣ�һ�㶼�Ƽ�ʹ��Progressive JPEG
* Progressive JPEG
        ��Baselineһ��ɨ�費ͬ��Progressive JPEG�ļ��������ɨ�裬��Щɨ��˳Ѱ�Ĵ洢��JPEG�ļ��С�
        ���ļ������У�������ʾ����ͼƬ��ģ������������ɨ����������ӣ�ͼƬ���Խ��Խ������
        ���ָ�ʽ����Ҫ�ŵ������������������£����Կ���ͼƬ������֪�����ڼ��ص�ͼƬ�����ʲô��
        ��һЩ��վ�򿪽ϴ�ͼƬʱ����ͻ�ע�⵽���ּ�����

```
int imageinterlace ( resource $image [, int $interlace = 0 ] )
If the interlace bit is set and the image is used as a JPEG image, the image is created as a `progressive` JPEG.

($interlace) If non-zero, the image will be interlaced, else the interlace bit is turned off.
```