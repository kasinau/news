<html>
<head>
    <title>News</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
        <h1>News blog...</h1>
    </div>
    <div id="menu_bar">
        <div class="menu_cell"><a href="index.php">Acasa</a> </div>
        <div class="menu_cell"><a href="social.php">Social</a> </div>
        <div class="menu_cell"><a href="#">Acasa</a> </div>
        <div class="menu_cell"><a href="#">Acasa</a> </div>
        <div class="menu_cell"><a href="#">Acasa</a> </div>
        <div class="menu_cell"><a href="#">Acasa</a> </div>
        <div class="menu_cell"><a href="#">Acasa</a> </div>
        <div class="menu_cell"><a href="#">Acasa</a> </div>
        <div class="menu_cell"><a href="#">Acasa</a> </div>
        <div class="menu_cell"><a href="#">Adauga o stire</a> </div>
    </div>
    <div id="content">
        <form action="form.php" method="post" enctype="multipart/form-data" name="registrationForm" id="registrationForm">
            <label for="firstName">Input your firstname: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
            <input type="text" name="firstName" id="firstName" class="validate" value="{$firstName}" />
            <i id="firstNameError" class="errorStyle">{$firstNameError}</i><br />
            <label for="lastName">Input your lastname:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
            <input type="text" name="lastName" id="lastName" class="validate" value="{$lastName}" />
            <i id="lastNameError" class="errorStyle">{$lastNameError}</i><br />
            <label for="login">Input your login:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="login" id="login" class="validate" value="{$login}" />
            <i id="loginError" class="errorStyle">{$loginError}</i><br />
            <label for="password">Input your password:&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="password" name="password" id="password" class="validate" />
            <i id="passwordError" class="errorStyle">{$passwordError}</i><br />
            <label for="retypePassword">Retype your password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="password" name="retypePassword" id="retypePassword" class="validate" />
            <i id="retypePasswordError" class="errorStyle">{$retypePasswordError}</i><br />
            <label for="email">Input your e-Mail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="email" id="email" value="{$email}" class="validate" />
            <i id="emailError" class="errorStyle">{$emailError}</i><br />
            <label for="male">Select your gender: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male</label>
            <input type="radio" name="sex" id="male" value="male" checked="checked" />
            <label for="female">Female</label>
            <input type="radio" name="sex" id="female" value="female" /><br />
            <label for="popupDatepicker">Input your date of birth here:</label>
            <input type="text" name="dateOfBirth" id="dateOfBirth"  value="{$dateOfBirth}" />
            <i id="dateOfBirthError" class="errorStyle">{$dateOfBirthError}</i><br />
            <label for="avatar">Select an avatar:&nbsp; </label>
            <input type="file" name="avatar" id="avatar" value="{$avatar}" />
            <i id="avatarError" class="errorStyle">{$avatarError}</i><br />
            <input type="submit" name="submit" id="submit" value="Send" />
        </form>
    </div>
    <div id="footer">
        Here will be the footer content...
    </div>
</div>
</body>
</html>