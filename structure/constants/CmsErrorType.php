<?php


namespace app\structure\constants;

class CmsErrorType
{
    const UNSET_DEFAULTTHEME = 'UNSET_DEFAULTTHEME';
    const ACTIVE_DEFAULTTHEME = 'ACTIVE_DEFAULTTHEME';
    const EMPTY_THEME = 'EMPTY_THEME';

    public static $list = [
        ErrorType::UNSET_DEFAULTTHEME => '默认主题未设定',
        ErrorType::ACTIVE_DEFAULTTHEME => '必须保留一个已经激活的主题',
        ErrorType::EMPTY_THEME => '必须保留一个主题',
    ];

    public static function getMessage($errorTypeKey = null)
    {
        return ErrorType::$list[$errorTypeKey];
    }

}