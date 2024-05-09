<body>
<div class="popup-container" id="forgot-popup">
                <div class="forgot popup">
                   <form method="POST" action="forget_password.php"> 
                        <h2>
                         <center>   <span>RESET PASSWORD</span> </center>
                           
                        </h2>
                        <input type="text" placeholder="E-mail" name="email">
                        <button type="submit" class="reset-btn" name="send-reset-link">SEND LINK</button><br><br>
                        <a href="login_form.php" class="login-btn">Go Back</a>
                    </form>
                </div>
            </div>
</body>

<style>
    

body{
    background-color: #cbf2fc;
}

form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f0f0f0;
            width: 350px;
            border-radius: 8px;
            padding: 20px 25px 30px 25px;
        }

div#forgot-popup{
    display: flex;
}


div.popup-container div.forgot button.reset-btn{
    font-weight: 550;
    font-style: 15px;
    color: white;
    background-color: #30475e;
    padding: 4px 10px;
    border: none;
    outline: none;
    margin-top: 5px;
}

div.popup-container div.forgot a.login-btn{
    font-weight: 550;
    font-style: 15px;
    color: white;
    background-color: #30475e;
    padding: 4px 10px;
    border: none;
    outline: none;
    margin-top: 5px;
}

div.popup-container div.forgot h2{
    color: #007187;
}

div.popup-container div.forgot input{
    border-bottom-color: #007187;
}

div.popup-container div.forgot button.reset-btn{
    background-color: #007187;
    border-radius: 3px;
}

div.popup-container div.forgot a.login-btn{
    background-color: #007187;
    border-radius: 3px;
}

</style>