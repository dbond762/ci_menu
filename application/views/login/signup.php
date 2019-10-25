<div class="row justify-content-center">
    <?php echo form_open('login/signup', array('class' => 'form-signin')); ?>
        <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>

        <?php echo validation_errors(); ?>
        <?php echo $message; ?>

        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" class="form-control" placeholder="Username" required="" autofocus="" name="username">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    </form>
</div>