<!DOCTYPE html>
<html lang="en" >
    <head>
        <title>Customer Batch Update</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/style.css">
        <script>
            function cloneValidate(url,index){
                if(window.confirm("Are you sure you want to clone?\nThis will create a duplicate in your table.")){
                    window.open(url,"_self");
                    return false;
                }else{
                    window.location.href = index;
                }
            }
            function delValidate(url,index){
                if(window.confirm("Caution! Data will be deleted!\nThis cannot be undone!")){
                    window.open(url,"_self");
                    return false;
                    //alert(url);
                }else{
                    window.location.href = index;
                }
            }
            function dtlOpenNewWindow(url){
                window.open(url,"_self");
                return false;
            }
 
            function updOpenNewWindow(url){
                window.open(url,"_self");
                return false;
            }
            function openPopUp(url){
                window.open(url);
                return false;
            }
            function updateValidate(){
                if(window.confirm("Are you sure you want to submit?")){
                    return true;
                }else{
                    return false;
                }
            }
            function redirectToMain(text,main){
                window.alert(text);
                window.location.href = main;
            }
            /*
            function redirectToIndex(text){
                window.alert(text);
                window.location.href = './.php';
            }
            /*var $my_form = $("#updateForm");
            $my_form.validate(function($form, e) {
                if (window.confirm("Are you sure you want to submit?")){
                     window.location = index.php;
                }
            })*/
        </script>
    </head>
    <body >
        <!--
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li></li>
                        <li></li>
                    </ul>

                </div>
            </div>
        </nav>-->