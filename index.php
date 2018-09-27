<?php
/** @author zGiuly_
 * Index file
 */
include 'PortScanner.php';
include 'settings.php';
if(!$settings['localhost_block']) {
    $Scanner = new PortScanner($_GET['ip']);
    $Scanner->Scan(0, 100, 'tcp');
    if (!$settings['json_response']) {
        echo "Opened: " . file_get_contents("open.txt") . " Closed: " . file_get_contents("closed.txt");
    } else {
        header('Content-Type: application/json');
        $return = ['Closed' => [str_replace("\n", " ", file_get_contents("closed.txt"))], 'Open' => [str_replace("\n", "", file_get_contents("open.txt"))]];
        print_r(json_encode($return));
    }
}else{
    if($_GET['ip'] != "localhost") {
        $Scanner = new PortScanner($_GET['ip']);
        $Scanner->Scan(0, 100, 'tcp');
        if (!$settings['json_response']) {
            echo "Opened: " . file_get_contents("open.txt") . " Closed: " . file_get_contents("closed.txt");
        } else {
            header('Content-Type: application/json');
            $return = ['Closed' => [str_replace("\n", " ", file_get_contents("closed.txt"))], 'Open' => [str_replace("\n", "", file_get_contents("open.txt"))]];
            print_r(json_encode($return));
        }
    }
}
?>