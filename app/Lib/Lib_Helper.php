<?php
/**
 * this class holds some stand alone methods serves some special purposes.
 * please do not place any method here may not relates with the framework itself (i.e. to serve a specific purpose of a project).
 * @author Md Fahim Uddin
 * @version 20160317
 */

final class Lib_Helper
{
    /**
     * this translates $searchFor (by default "_") to DIRECTORY_SEPARATOR
     * i.e. path_to_file_fileName.php will become "path/to/file/"
     * @param string $string
     * @param bool $getFileName
     * @param string $searchFor
     * @return string (i.e. "path/to/file/" or "path/to/file/path_to_file_fileName.php")
     */
    public function strToPath($string, $getFileName = false, $searchFor = '_')
    {
        $dir = dirname(str_replace($searchFor, DIRECTORY_SEPARATOR, $string));

        if ($dir == '.') {
            $dir = '';
        } else {
            $dir .= DIRECTORY_SEPARATOR;
        }

        if ($getFileName === true) {
            $dir .= $string;
        }

        return $dir;
    }

    /**
     * @param string $urlPath (i.e. /Admin/Home)
     * @param array $queryStrings (i.e. array('id' => 10))
     */
    public function redirect($urlPath, $queryStrings = array())
    {
        $qs = array();
        if (is_array($queryStrings) && count($queryStrings) > 0) {
            foreach ($queryStrings as $key => $value) {
                $qs[$key] = $value;
            }
        }

        if (count($qs) > 0) {
            $qs = '?qs=' . rawurlencode(urlencode(json_encode($qs)));
        } else {
            $qs = '';
        }

        ob_end_clean(); //in-case header already printed
        header("Location: {$urlPath}{$qs}");
        exit();
    }
}