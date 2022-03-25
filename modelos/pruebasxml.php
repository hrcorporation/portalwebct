<?php
require '../librerias/autoload.php';
require '../modelos/autoload.php';
require '../vendor/autoload.php';

$firephp = FirePHP::getInstance(true);

$file_xml = 'FV9-0000000143-AR.xml';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div id="link">

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var apiURL = 'https://api.tsomobile.com/rest/';
    var token = "";
    $(document).ready(function () {
        //Authenticate to the API and get the Token
        //var login = prompt("Please enter your login", "");
        //var pwd = prompt("Please enter your password", "");

        ///////
        var login = 'SISTEMASCONCRETOL';
        var pwd = 'Nirvana3343';
        var token = '101262D0-98DE-4EAA-A836-C5CEE2D27D4B';
        if (login == "" || pwd == "") {
            alert("Login and Password are required");
        }
        else {

            get_units(function(rs){
                if (rs.Code == 1){ //OK
                    //console.log(rs.Data.map((unit) => unit.ShortName));
                    var placa = rs.Data.map((unit) => unit.ShortName);
                    var latitud = rs.Data.map((unit) => unit.LastLatitude);
                    var longitud = rs.Data.map((unit) => unit.LastLongitude);
                    const htmlresponse = document.querySelector('#link');
                    var ep = '';
                    
                    var googlemaps = 'https://www.google.com/maps/search/?api=1&query='+latitud+'%2C'+longitud;
                    htmlresponse.innerHTML = '<a href="'+googlemaps+'">hd</a>';
                }
                else {
                    alert("Code: " + rs.Code + ", Msg: " + rs.Message);
                }
            });

          
            
        }
    });


    /*------------------------------------------------------
        Unidades
    --------------------------------------------------------*/
    function get_units(callback) {
        $.ajax({
            url: apiURL +'/Units/UnitList',
            type: 'POST',
            data: JSON.stringify({
                    "token": '101262D0-98DE-4EAA-A836-C5CEE2D27D4B'
                }),
            async: true,
            contentType: "application/json;charset=utf-8",
            dataType: 'json',
            timeout: 300000,
            cache: false,
            success: function (response) {
                if(typeof(callback) != 'undefined')
                    callback(response);
                },
            error: function (x, y, z) {
                alert('Error executing validateUser');
                }
        });
    }



    /*-----------------------------------------------------
    -- Validate user credentials
    ------------------------------------------------------*/
    function validateUser(login, pwd, callback) {
        $.ajax({
            url: apiURL + 'Authentication/ValidateUser',
            type: 'POST',
            data: JSON.stringify({
                    login: escape(login),
                    password: pwd
                }),
            async: true,
            contentType: "application/json;charset=utf-8",
            dataType: 'json',
            timeout: 300000,
            cache: false,
            success: function (response) {
                if(typeof(callback) != 'undefined')
                    callback(response);
                },
            error: function (x, y, z) {
                alert('Error executing validateUser');
                }
        });
    }
</script>
</body>
</html>



<?php


/* 
fb('Log message'  ,FirePHP::LOG);
fb('Info message' ,FirePHP::INFO);
fb('Warn message' ,FirePHP::WARN);
fb('Error message',FirePHP::ERROR);

**/