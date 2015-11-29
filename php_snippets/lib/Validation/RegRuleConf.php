<?php
namespace Core\Lib\Validation;
class RegRuleConf
{
    // 数字
    const NUMBER = '/^[+-]?[1-9][0-9]*(\.[0-9]+)?([eE][+-][1-9][0-9]*)?$|^[+-]?0?\.[0-9]+([eE][+-][1-9][0-9]*)?$/';
    // 整数
    const INT = '/^-?[0-9]\d*$/';

    //正整数
    const UP_INT = '/^[1-9]\d*$/';

    //非负整数
    const HIGH_INT = '/^\d+$/';

    //非负数，包括（小数，0，正整数)
    const HIGH_FLOAT_INT_ZERO = '/^([1-9]\d*|\d+\.\d+|0)$/';

    //非负数，包括（小数，正整数)
    const HIGH_FLOAT_INT = '/^([1-9]\d*|\d+\.\d+)$/';

    // 手机
    const MOBILE = '/^1[34587]\d{9}$/';

    // 电话
    const TELEPHONE = '/^(?:(?:0\d{2,3}[- ]?[1-9]\d{6,7})|(?:[48]00[- ]?[1-9]\d{6}))$/';

    // 身份证
    const IDENTITY = '/(^\d{15}$)|(^\d{17}(?:\d|x|X)$)/';

    // 日期
    const DATE = '/^\d{4}(-|\/|\.)\d{1,2}\1\d{1,2}$/';

    // 邮编
    const CODE = '/^\d{6}$/';

    // 中文正则
    const CN = '/^[\x80-\xff]+$/';

    // 颜色
    const COLOR = '/^#?[a-fA-F0-9]{6}$/';

    // ASCII字符
    const ASCII = '/^[\x00-\xFF]+$/';

    // 图片
    const IMAGE = '/(.*)\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$/i';

    //车牌号php
    const CAR_NUMBER = '/^[\x80-\xff]{3}([A-Z0-9]{1}|[0-9]{2})(([0-9ABCDEFGHJKLMNPQRSTUVWXYZ]{5})|([0-9ABCDEFGHJKLMNPQRSTUVWXYZ]{4}(学|挂)))$/';

}