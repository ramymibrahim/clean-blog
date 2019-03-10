<?php
function getRows($q){    
    $con=mysqli_connect('localhost','root','','clean_blog');    
    
    $query=mysqli_query($con,$q);
    $rows=[];
    while($row=mysqli_fetch_array($query)){
        array_push($rows,$row);
    }
    mysqli_close($con);
    return $rows;
}

function getRow($q){    
    $con=mysqli_connect('localhost','root','','clean_blog');        
    $query=mysqli_query($con,$q);    
    $row=mysqli_fetch_array($query);    
    mysqli_close($con);
    return $row;
}

function executeQuery($q){
    $con=mysqli_connect('localhost','root','','clean_blog');        
    $query=mysqli_query($con,$q);
    return $query;
}