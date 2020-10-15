<!DOCTYPE html>
<html>
  <head>
    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello,world!</h1>
    <p><?php echo 'We are running PHP, version ' . phpversion(); ?></p>
    <p><?php phpinfo(); ?></p>
    <p>
      <?php

        function divideOneByNumber($number) {
          if ($number == 0) {
            throw new Exception('Cannot divide by Zero!');
          }
          return 1/$number;
        }

        try {
          echo 'The result of the division is ' . divideOneByNumber(0);
        }
        catch (Exception $e) {
          echo 'Message: ' . $e->getMessage();
        }

      ?>
    </p>
  </body>
</html>