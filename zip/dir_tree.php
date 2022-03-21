<?php


function getDirectory($path = '.')
{
    $ignore = array('.', '..');
    $dir_arr = opendir($path);
    while (false !== ($file = readdir($dir_arr))) {
        
        if (!in_array($file, $ignore)) {
            if (is_dir("$path/$file")) {
                getDirectory("$path/$file");
            } else {
                $ex = explode('.', $file);
                $ex = end($ex);
                if ($ex == 'png' || $ex == 'jpg') {
                    echo "<img width='320' height='240' src='$path/$file' alt= srcset=> <br>";
                } else if ($ex == 'mp4' || $ex == 'mkv' || $ex == 'avi' || $ex == 'flv' || $ex == '3gp') {
                    echo "
                           <video width='320' height='240' controls autoplay>
                               <source src=\"$path/$file\" type='video/$ex'>
                               </video> <br>";
                } else if ($ex == 'mp3' || $ex == 'wav' || $ex == 'ogg')  {
                    echo "
                           <audio width='320' height='240' controls autoplay>
                               <source src=\"$path/$file\" type='audio/$ex'>
                               </audio> <br>";
                } else {
                    echo "
                            <a href=\"$path/$file\">$file</a> <br>";
                }
            }
        }
    }
}
