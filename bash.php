<?php



function getNucMonitor()
{
    unlink('monitor.php');
    if(@file_get_contents('https://boe-php.eletromidia.com.br/rmc/nuc/monitor/get?csrf='.md5(time()), "r") !='v0' )
    {
        $fp = fopen( getcwd().DIRECTORY_SEPARATOR.'monitor.php','w');
        fwrite($fp,  '<?'.file_get_contents('https://boe-php.eletromidia.com.br/rmc/nuc/monitor/get?csrf='.md5(time())));
        fclose($fp);
        unset($fp);    }
    else echo 'No version in server'.PHP_EOL; 
}



function getPrepare()
{
    unlink('prepare.php');
    $fp = fopen( getcwd().DIRECTORY_SEPARATOR.'prepare.php','w');
    fwrite($fp,  '<?'.file_get_contents('https://boe-php.eletromidia.com.br/rmc/nuc/prepare/get?csrf='.md5(time())));
    fclose($fp);
    unset($fp);
}


function getRobot()
{
    unlink('robot.php');
    $updatedCode = file_get_contents('https://boe-php.eletromidia.com.br/rmc/nuc/robot/get?csrf='.md5(time()));
    if(empty($updatedCode))
    {
        echo 'no code on server'.PHP_EOL;
    }
    if(!empty($updatedCode))
    {
        // Overwrite the current class code with the updated code
        $fp = fopen( getcwd().DIRECTORY_SEPARATOR.'robot.php','w');
        fwrite($fp,  '<?'.$updatedCode );
        fclose($fp);
        unset($fp);
    }
}


getPrepare();
getNucMonitor();
#getRobot();

var_dump(shell_exec("php prepare.php  deploy"));
echo PHP_EOL;
sleep(2);

// shell_exec("php robot.php");
// sleep(2);
// var_dump(shell_exec("php monitor.php  deploy"));
// echo PHP_EOL;
