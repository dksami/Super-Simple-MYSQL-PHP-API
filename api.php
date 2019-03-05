<?php
//SuperSimple Api Created By Raja Osama
//Api Github Link 

//Simply Add Your connection Detail over here!
function con(){
    $localhost = "localhost";
    $db = "project";
    $user = "root";
    $password = "";
    return mysqli_connect($localhost,$user,$password,$db);
}
//Verifying if Connection Works !
if(con()){

}else{
    echo "failed";
}


//Now the Fun
if(isset($_POST['request'])){
    if($_POST['request'] == "select"){
    $query = $_POST['query'];
     $exe = mysqli_query(con(),$query);
    if(!$exe){
        $obj = (object) [
            'Error' => 'A problem Occured',
            'Query' => $query
        ];
        
        echo json_encode($obj);  }else{
        $rows = array();
while($r = mysqli_fetch_assoc($exe)) {
    $rows[] = $r;
}
print json_encode($rows);
    }
    }
    if($_POST['request'] == "action"){
        $query = $_POST['query'];
        if(strpos(strtolower($query), 'select') !== false){
            echo "Donot use Select HERE";
        }else{
        $exe = mysqli_query(con(),$query);
       if(!$exe){
        $obj = (object) [
            'Error' => 'A problem Occured While Perfroming Action',
            'Query' => $query
        ];
        
        echo json_encode($obj); 
       }else{
        $obj = (object) [
            'Success' => 'Successfull',
            'Query' => $query
          ];
        
        echo json_encode($obj); 
       } 
    }
}
  
}

?>
