<!DOCTYPE html>
<div class="container">
    <div class="page-header">
      <h2>User data</h2>
      <h4>You can change your name, email adress, username or password.</h4>
    </div>
  </div>

<div class="container">
    
    <form class="form-signin" method="post" action="index.php" id="login">

        <h2 class="form-signin-heading">Update your data</h2>
        
        <label for="name" class="sr-only">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $user->getName(); ?>" maxlength="25" placeholder="Name" required autofocus/>
        
        <label for="email" class="sr-only">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo $user->getEmail(); ?>" maxlength="25" placeholder="Email" required/>
        
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?php echo $user->getUsername(); ?>" maxlength="25" placeholder="Username" required/>
        
        <label for="password" class="sr-only">Password</label>
        <input type="text" name="password" id="password" class="form-control" value="<?php echo $user->getPassword(); ?>" maxlength="25" placeholder="Password" required/>
        
        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Update">Update</button>

    </form>  

</div>

<br />

<form class="form-signin" method="post" action="index.php">
    <button class="btn btn-sm btn-primary btn-block" type="submit" name="submit" value="Back">Back</button>
</form>
