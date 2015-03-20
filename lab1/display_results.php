<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Thank you!</title>
    <link rel="stylesheet" type="text/css" href="Style.css"/>
</head>
<body>
    <div id="form">
        
        
        <h1>Summary of Account Information</h1>
        
        
        <form>    
        <fieldset>
        <label>First Name</label>
        <span><?php echo ($first); ?></span><br />

        <label>Last Name</label>
        <span><?php echo ($last); ?></span><br />

        <label>Email Address</label>
        <span><?php echo ($email); ?></span><br />

        <label>Password</label>
        <span><?php echo ($password); ?></span><br />

        <label>Phone Number</label>
        <span><?php echo ($phone); ?></span><br />

        
        <p>&nbsp;</p>
        
        </fieldset>
        
        </form>
        
    </div>
</body>
</html>
