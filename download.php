<?php
if(!isset($_SESSION)){
    session_start();
}

$title = $_SESSION['title'];
$data = $_SESSION['data'];

$path_file = dirname($_SERVER['SCRIPT_FILENAME']) . '/tmp/' . $title . '.txt';
if(!download_file($path_file, $data)){
    header('Location: error_page.php');
}
/////////////////////////////////////////////////
function download_file($path_file, $data){
    
    try {
        // if there is already the file in tmp/ then don't write
        if (!file_exists($path_file)) {
            // write data in tmp directory
            if (!file_put_contents($path_file, $data)) {
                throw new RuntimeException("Error: Cannot write the file(" . $path_file . ")");
            }
        }
        // download the file on local. (user can select where to save)
        /* check if file exists */
        if (!file_exists($path_file)) {
            throw new RuntimeException("Error: File(" . $path_file . ") does not exist.");
        }

        /* check if the file can be opend */
        if (!($fp = fopen($path_file, "r"))) {
            throw new RuntimeException("Error: Cannot open the file(" . $path_file . ")");
        }
        fclose($fp);

        /* check the file size */
        if (($content_length = filesize($path_file)) == 0) {
            throw new RuntimeException("Error: File size is 0.(" . $path_file . ")");
        }

        /* header info for Download */
        header("Content-Disposition: inline; filename=\"" . basename($path_file) . "\"");
        header("Content-Length: " . $content_length);
        header("Content-Type: application/octet-stream");

        /* output file */        
       if (!readfile($path_file)) {
            throw new RuntimeException("Cannot read the file(" . $path_file . ")");
        }
        return TRUE;
    } catch (Exception $e) {
    //    $error = $e->getMessage();
        return FALSE;
    }    
}