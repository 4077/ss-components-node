<?php namespace ss\components\node;

class Svc
{
    public static function renderExplodedPath($path)
    {
        $absPath = app()->paths->resolve($path, '/ -');

        list($modulePath, $nodePath) = app()->paths->separateAbsPath($absPath);

        if (preg_match('/\/\d/', $nodePath)) {
            appc()->console('incorrect node path (numeric first symbol): ' . $nodePath);

            return [false, false];
        } else {
            return [$modulePath, $nodePath];
        }
    }
}