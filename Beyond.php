<html>
<head>
    
</head>
    <body>
        <?php
        echo mktime(2, 30, 45, 10, 1, 2009);//hour-min-sec-month-day-year
        echo "<br/>";
        $curenttime = time();
        echo strftime("The date today is %m/%d/%y");
        echo "<br/>";
        echo strftime("The date today is  still %m/%d/%y", $curenttime)."<br/>";
        
        function remove_zeros($marked_string){
            $no_zeros = str_replace('*0','',$marked_string);//remove *0
            $no_zeros;
            $clean_string = str_replace('*','',$no_zeros); //remove * in month like December(12)
            return $clean_string;
        }
        
        echo remove_zeros(strftime("The date without zeros is *%m/*%d/*%y", $curenttime))."<br/>";
        //change to sql date style
        $datetime = strftime("%y-%m-%d %H:%M:%S", time());
        echo $datetime."<br/>";
        $datetime = strftime("%Y-%m-%d %H:%M:%S", time());
        echo $datetime."<br/>";
        
        function test(){
            static $var=2; //if it's not static, d value of $var will always go back to 2 and start d function process again
            echo $var."<br/>";
            $var++;
        }
        test();
        test();
        test();
        
        $a = 1;
        $b =& $a;//b references(points to) a; so when u change d value of b, a is also changed
        $b = 2;
        echo "a: {$a} / b: {$b}<br/>";
        unset($b); //remove the value of b
        echo "a: {$a} / b: {$b}<br/>"; 
        
        function ref_test($rut){ $rut = $rut * 2; }
        $y = 10;
        ref_test($y);
        echo "the value of y remains ",$y."<br/>";//bcos we defined y as a global variable, it never changes
        
        function ref_test2(&$rut)//when something comes in, make a reference to it
        { $rut = $rut * 2; }
        $y = 10;
        ref_test2($y);
        echo "the value of y is now ",$y."<br/>";//bcos we defined y as a global variable, it never changes
        
        //this does the same as ref_test2
        function ref_test3(){//u can leave d argument empty since u r using only one letter
            global $y;
            $y = $y * 2;
        }
        $y = 10;
        ref_test3();
        echo "the value of y is now ",$y."<br/>";
        ?>

        <?php
        //require_once('database.php');
        mysqli_connect("localhost","root","","2017");
       class User{
        public function find_all(){
            global $database;
            $result_set = $database->query("SELECT * FROM users");
            return $result_set;
        }
        public function find_by_id($id=0){
            global $database;
            $result_set=$database->query("SELECT * FROM users WHERE id={$id} ");
            $found = $database->fetch_array($result_set);
            return $found;
        }
        public function create(){
        global $database;
        $sqql = "INSERT INTO users(";
        $sqql .= "username, password, first_name, last_name";
        $sqql .= ") VALUES ('";
        $sqql .= $database->escape_value(this->username)."', '";
        $sqql .= $database->escape_value(this->password)."', '";
        $sqql .= $database->escape_value(this->profession)."', '";
        $sqql .= $database->escape_value(this->email)."')";
        if ($database->query($sqql)) {
          $this->id = $database->insert_id();
          return true;
        }
        else{return false;}
       }
       }
       echo __LINE__."<br/>" ; //gives d current line number, but may differ when we r importing files
       echo __FILE__."<BR/>" ; //gives d full path to get to this file
       echo dirname(__FILE__)."<br/> " ; //gives directory info about this file
       echo __DIR__;//also gives directory info about this file..works in php 5.3
       echo "<br/>1";
       echo file_exists(__FILE__)? 'yes':'no';
       echo "<br/>2";
       echo file_exists(__DIR__."/basic.html" )? 'yes':'no';
       echo "<br/>3";
       echo file_exists(__DIR__."/beyond.php" )? 'yes':'no';
       echo "<br/>4";
       echo is_file(__DIR__."/beyond.php")? 'yes':'no';
       echo "<br/>5";
       echo is_dir(__DIR__."/beyond.php")? 'yes':'no';
       echo "<br/>6";
       echo is_dir('..')? 'yes':'no';
       echo "<br/>";
       echo fileowner('Diary.php')."<br/>" ; //gives d id, not name
       /*posix library is not installed on windows
       $owner_id = fileowner('Diary.php');
       $owner_array = posix_getpwuid($owner_id);
       echo $owner_array['name']; */
       echo fileperms('Diary.php')."<br/>" ; //gives unusable decimal representation
       echo decoct(fileperms('Diary.php')) ."<br/>" ; //converts to octal
       echo substr(decoct(fileperms('Diary.php')), 2)  ."<br/>" ;
       //chmod ('Diary.php',0444); //change permissions
       echo is_readable('Diary.php')? 'yes' : 'no';
       echo "<br/>";
       echo is_readable('Diary.php')? 'yes' : 'no';
       echo "<br/>";
       $filename = 'PHPFirst.php';
       echo strftime('%m/%d/%Y %H:%M', filemtime($filename))."<br/>" ;//last modified(content) time
       echo strftime('%m/%d/%Y %H:%M', filectime($filename))."<br/>";//last changed(content/metadata) time
       echo strftime('%m/%d/%Y %H:%M', fileatime($filename))."<br/>";//last accessed(read/change) time

       $pathss = pathinfo(__FILE__);
       echo $pathss['dirname']."<br/>";
       echo $pathss['basename']."<br/>";
       echo $pathss['filename']."<br/>";
       echo $pathss['extension']."<br/>";

       echo getcwd()."<br/>"; //get current  working directory
       echo mkdir('new', 0777);//make new dirctory with 0777.i.e. open permissions

       $dir = "."; //current working directory
       if (is_dir($dir)){
        if($dir_handle = opendir($dir)){
            while ($filename=readdir($dir_handle)) {
                echo "filename: {$filename}<br/>";
            }
            rewinddir($dir_handle);
            closedir($dir_handle);
        }
       }//$_FILES['file_upload']['name']//delete soon
       echo "<pre>";
       print_r($_FILES['file_upload']); //print out d array d uploaded file
       echo "</pre>";
       echo "<hr/>";

       
  ?>
<!--html continues-->
<form action = "SQLL.php" enctype="multipart/form-data" method = "POST"> <!--The type of data it'll be sending will be multi types-->
  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /><!--set max size b4 d file input field-->
  <input type="file" name="file_upload" />
  <?php if(!empty($msg)) {echo "<p>{$msg}</p>";} ?> <!--displays a msg when user uploads, successful/failed-->
  <input type="submit" name="submit" value="Upload" />
</form>
    </body>
</html>