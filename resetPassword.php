<?php
require_once "Utilities/helpers.php";
session_start();

function setError($message)
{
    $_SESSION['error'] = $message;
    header("Location: login.php");
    die();
}


if (isset($_POST['submit'])){
    

    $query = "SELECT id FROM `User` WHERE email=:em";
    $params = array(
        ':em' => $_POST['email']
    );
    $result = executeQueryResult($pdo, $query, $params)[0];
    if ($result){
        $user_id = $result['id'];
        $token = hash('sha256', $user_id.date("YmdHis"));
        
        $query = "INSERT INTO `ForgetPassword` VALUES (:tk, :id)";
        $params = array(
            ':tk' => $token,
            ':id' => $user_id
        );

        try{
            $res = executeQuery($pdo, $query, $params);
            // ---------code to send mail ---------

            // ------
            $_SESSION['success'] = "Link to reset password sent to your mail id";
            header("Location: resetPassword.php");
            die();
        } catch(Exception $e){
            setError("Error: ". $e -> errorInfo[1]);
        }

        


    } else {
        setError("This Email ID is not registered");
    }

    

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - <?php echo $title ?></title>
    <link rel="stylesheet" href="Styles/loginStyle.css">
    <?php importBootstrapCSS();
    setFont(); ?>
</head>

<body>
    <div class="mainContainer d-flex justify-content-center align-items-center p-5">
        <div class="loginContainer d-flex justify-content-center align-items-center px-5 py-3 flex-column">
            <h1>Reset Password</h1>
            <form method="POST" id="loginForm">
                <div>
                    <label class="error p-0 m-0">
                        <?php if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        } ?>
                    </label><br>
                    <label class="text-success p-0 m-0">
                        <?php if (isset($_SESSION['success'])) {
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        } ?>
                    </label>
                </div>
                <div class="form-group">
                    <label for="input_email">
                        Email
                    </label>
                    <input type="email" name="email" id="input_email" class="form-control">
                </div>
                <div class="buttonContainer d-flex justify-content-center align-items-center flex-wrap">
                    <button class="btn btn-primary m-1" type="submit" name="submit" value="submit">
                        Send Reset Link
                    </button>
                </div>
            </form>
            
        </div>
    </div>

    <?php importBootstrapJS(); ?>

    <script>
        $('#loginForm').validate({
            rules: {
                email: "required",
            },
            messages: {
                email: "Please Enter Valid Email",
            }
        });
    </script>
</body>

</html>

