<?php require_once "connection.php"; $conn = OpenConnection();?>

 <html>

<head>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        html,body{
            overflow-x: hidden;
            margin: 0;
        }
        .parent{
            width: 100%;
            height: 100%;
            background-image: linear-gradient(#1e6091, beige);
        }
        
        h4{
            text-align: center;
            color: beige;
            font-family:Arial, Helvetica, sans-serif;
            padding-top: 50px;
        }
        
        
        .for{
            width: 380px;
            border-radius:40px;
            border: solid rgb(12, 142, 146) 1px;
           height: 50px;
           background-color: beige;
           color: cadetblue;
           margin-left: 20px;
        
        }
        label{
            color:cadetblue;
            margin-left: 30px;
        }
        .submit1{
            border: none;
            justify-content:center;
            align-items: center;
            background-color: 569DAA;
            color: white;
            width: 150px;
            margin-top: 20px;
            height: 30px;
            border-radius: 30px;
            font-size: 20px;
            margin-left: 50px
        }
        a{
            text-decoration: none;
            color:cadetblue;
           
        }
        a:hover{
            color: bisque;
        }
        
        .frame{
            height: 500px;
            width: 450px;
            background-color: cornsilk;
            justify-content: center;
            align-items: center;
           margin-left: 470px;
        }
        
        
        
        
        .contact{
            width: 100%;
        height: 100vh;
            background-size: cover;
            
        }
        
        .overlay{
            width: 100%;
            height: 300px;
            background-color:darkcyan;
        }
        
        .p1{
          
            margin-left: 570px;
            font-size: 25px;
            color: beige;
        }
        
        
        .info{
         padding-left: 50px;
            align-items: center;
            height:326px;
            margin-top: 10px;
        
        }
        
        .info2{
            margin-top: 10px;
          
        }
        .for2{
            width: 70%;
            height: 50px;
        }
        
        textarea{
            height: 100px;
            width: 70%;
        }
        
        .submit{
            border: none;
            width: 20%;
        }
        
        .last{
            width: 100%;
            background-color: #feb777;
            padding-top: 20px;
            align-items: center;
            margin: 0;
        }
        
        .fa-location-dot{
            font-size: 30px;
            padding-left: 10px;
            transition: 1s;
        }
        
        .fa-location-dot:hover{
            color: #1e6091;
        } 
        .fa-envelope{
            font-size: 30px;
            padding-left: 50px;
            transition: 1s;
        }
        .fa-envelope:hover{
            color: #1e6091;
        }
        .f{
            padding-left: 45px;  
        }
        
        .fa-phone{
            font-size: 30px;
            padding-left: 10px;
            transition: 1s;
        }
        .fa-phone:hover{
            color: #1e6091;
        }
        .section1{
            padding-left: 110px;
        }
        
        
        
        .about{
            width: 100%;
            height: 70%;
           
           background-image: linear-gradient(#1e6091, white);
        
        }
        
        .w{
            width: 100%;
            height: 100%;
        }
        
        .n{
            font-size: 20px;
            font-weight: 500;
            font-style: oblique;
        }
        
        .mission{
            margin-top: 20px;
            margin-left: 20px;
        }
        .mission2{
            margin-left: 110px;
            background-color: white;
        }
        .about2{
            margin-top: 20px;
            
        }
        
        .vision2{
            padding-left: 30px;
        }
        
        .vision2 h4{
            color: black;
            margin-left: -90px;
           padding-bottom: 10px;
        }
        
        .vision2 p{
            font-size: 20px;
            font-style: italic;
        }
        
        .about3{
            width: 100%;
            height: 500px;
            background-color: cornflowerblue;
        }
        
        
        
        .leader h5{
            padding-left: 30px;
           
            
         
        }
        
        .leadership{
            margin-top: 30px;
            width: 1100px;
           margin-left: 150px;
        }
        
        .about4{
            width: 100%;
            height: 600px;
            margin-bottom: 30px;
            
        }
        
        .z{
            width: 100%;
            height: 100%;
        }
        
        .box{
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin-top: 20px;
            margin-left: -50;
            
        }
        
        .top{
            position: absolute;
            width: 200px;
            height: 202px;
            border-radius: 50%;
            background-color: rgba(51, 49, 49, 0.685);
            opacity: 0;
            transition: 1s;
            margin-top: 19px;
            align-items: center;
            margin-left: -50;
        }
        .leader{
            position: relative;
        }
        .leader:hover .top{
            opacity: 1;
        }
        
        .top p{
            margin-top: 120px;
            margin-left: 60px;
            color: white;
        }
        
        .lead{
            color: #1e6091;
            font-size: 30px;
        }
        
        
        .fff{
            margin-bottom: 50px;
            background-color:BFDCE5;
        margin-top: 50px;
        align-items: center;
        height: 300px;
        padding-top: 40px;
        
        }
        
        .fff p{
            margin-left: 400px;
        }
        .fff h5{
            margin-left: 600px;
        }
        
        .reqform{
            margin-top: 40px;
            padding-bottom: 15px;
            width: 70%;
            margin-left: 160px;
            background-color: #bfdce5;
        }
        .reqform input,label{
            padding-bottom: 10px;
        }
        .reqform button{
            width: 150px;
        }
        
        .reqform h4{
          
            color: #1e6091;
        }
        .reqform label{
            color: #1e6091;
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 2px;
        }
        
        .req h3{
            margin-left: 370px;
            color: #1e6091;
        }</style>
</head>
<body>
<div class="parent">
    <h4>
        Login to CURE4SOUL
    </h4>
    <div class="frame">

        <form method="POST" action="logform.php">

            <br><br>
            
            <label for="email">Enter your email</label><br>
            <input class="for" type="text" id="email" name="email" required><br>
            <br>
            <label for="password">Enter your password</label><br>
            <input class="for"  type="password" id="password" name="password" required><br><br>


            <button type="submit" name="login" class="submit1">Login</button><br><br>
            <?php if(isset($error)) {?>
            <p><?php echo $error ;?></p>
             <?php } ?>

            <a href="forgot.html" style="padding-left: 20px;">forgot your password?</a>
            </form>
    </div>
 
</div>
</body>
</html>