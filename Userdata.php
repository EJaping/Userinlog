<!DOCTYPE html>

<div class="container">
    <h2>User data</h2>
    
    <p><?php echo $_SESSION["message"]; ?></p>
</div>

<br />

<form class="form-signin" method="post" action="index.php" id="changedata">
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Change data">Change data</button>
</form>

<br />

<form class="form-signin" method="post" action="index.php">
    <button class="btn btn-sm btn-primary btn-block" type="submit" name="submit" value="Back">Back</button>
</form>
