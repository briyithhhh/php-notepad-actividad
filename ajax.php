<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Los_Angeles');

if (isset($_POST['action'])) {
    $dir = __DIR__ . '/';
    $filename = isset($_POST['filename']) && !empty($_POST['filename']) ? $_POST['filename'] . ".txt" : "Untitled.txt";
    $file = $dir . $filename;

    switch ($_POST['action']) {
        case "get":
            $files = glob($dir . "*.txt");
            $file_list = "";
            foreach ($files as $file) {
                $filename = basename($file, ".txt");
                $file_list .= "<option value='" . htmlentities($filename, ENT_QUOTES, 'UTF-8') . "'>$filename</option>";
            }
            $notes = $file_list ? $file_list : "No notes";
            echo $notes;
            break;

        case "load":
            if (file_exists($file)) {
                $notes = file_get_contents($file);
                echo $notes;
            } else {
                echo "File not found.";
            }
            break;

        case "save":
            if (isset($_POST['content'])) {
                $fh = fopen($file, 'w');
                fwrite($fh, $_POST['content']);
                fclose($fh);

                echo '» ' . date('g:i:s A');
            }
            break;
    }
}
?>
