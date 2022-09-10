<?php 
namespace App\Helpers;

class ArrayResponse{

    protected static array $result = [
        'success'   => true,
        'message'   => 'Success',
        'data'      => null
    ];

    public static function success(String $message = '', $data = null) : array
    {
        self::$result['message'] = $message;
        self::$result['data'] = $data;
        return self::$result;
    }
    public static function error(String $message = '') : array
    {
        self::$result['success'] = false;
        self::$result['message'] = $message;
        return self::$result;
    }
}

?>