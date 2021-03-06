<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>The Endless Enigma</title>
  <link href="enigma.css" type="text/css" rel="stylesheet" />
</head>
<body>
<header>
  <figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure>
  <nav>
    <ul>
      <li><a href="enigma.php">Enigma</a></li>
      <li><a href="settings.php">Settings</a></li>
      <li class="selected"><a href="batch.php">Batch</a></li>
      <li><a href="./">Ausloggen</a></li>
    </ul>
  </nav>
</header>
<div class="body">
  <div class="enigma" id="enigma">
    <figure class="enigma"><img src="images/rotors.png" alt="Enigma Rotors" width="1024" height="580"></figure>
    <p class="wheel wheel-s wheel-1">A</p>
    <p class="wheel wheel-s wheel-2">A</p>
    <p class="wheel wheel-s wheel-3">A</p>
  </div>
  <form class="dialog" method="post" action="post/batch.php">
    <div class="encoder">
      <p><textarea name="from"></textarea> <textarea name="to"></textarea></p>
      <p><input type="submit" name="encode" value="Encode ->">
        <input type="submit" name="decode" value="Decode <-"> <input type="submit" name="reset" value="Reset"></p>
    </div>
  </form>
</div>
<footer>
  <p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
</footer>
</body>
</html>
