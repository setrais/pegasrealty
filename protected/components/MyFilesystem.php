<?php

/**
 * Работа с файловой системой
 *
 * @package system
 * @author Dmitriy Neshin
 */
class MyFilesystem
{
    public static function makeDirs($path, $mode = 0755, $recursive = true)
    {
        $dir = substr($path, 0, strrpos($path, '/'));
        if (!file_exists($dir)) {
            mkdir($dir, $mode, $recursive);
        }
        return $path;
    }

    public static function readDir($path)
    {
        $files = array();
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $files[] = $file;
                }
            }
            closedir($handle);
        }
        return $files;
    }
}
