<?php include('header.php') ?>
<div class="d-flex justify-content-center">
    <section class="index-login">
        <div class="wrapper d-flex justify-content-around" style="width:500px">
            <div class="index-login-signup">
                <h4 style="text-align:center">SIGN UP</h4>
                <form action="../index.php" method="post" class="d-flex flex-column">
                    <input type="hidden" name="action" value="signup">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwdrepeat" placeholder="Repeat Password">
                    <input type="text" name="email" placeholder="E-mail">
                    <br>
                    <button type="submit" name="submit">SIGN UP</button>
                </form>
            </div>
            <div class="index-login-login">
                <h4 style="text-align:center">LOGIN</h4>
                <form action="../index.php" method="post" class="d-flex flex-column">
                <input type="hidden" name="action" value="login">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <br>
                    <button type="submit" name="submit">LOGIN</button>
                </form>
            </div>
        </div>

    </section>
</div>
    <?php include('footer.php') ?>