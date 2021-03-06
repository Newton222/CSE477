<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>The Endless Enigma</title>
  <link href="enigma.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<header>
  <figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure>
  <nav>
    <ul>
      <li><a href="enigma.php">Enigma</a></li>
      <li class="selected"><a href="settings.php">Settings</a></li>
      <li><a href="batch.php">Batch</a></li>
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
  <form class="dialog" method="post" action="post/settings.php">
    <p><label for="rotor-1">Rotor 1:</label>
      <select id="rotor-1" name="rotor-1">
        <option value="1" selected>I</option>
        <option value="2">II</option>
        <option value="3">III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
      </select>&nbsp;&nbsp;
      <label for="initial-1">Setting:</label>
      <input class="initial" id="initial-1" name="initial-1" type="text" value="A">
    </p>
    <p><label for="rotor-2">Rotor 2:</label>
      <select id="rotor-2" name="rotor-2">
        <option value="1">I</option>
        <option value="2" selected>II</option>
        <option value="3">III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
      </select>&nbsp;&nbsp;
      <label for="initial-2">Setting:</label>
      <input class="initial" id="initial-2" name="initial-2" type="text" value="A">
    </p>
    <p><label for="rotor-3">Rotor 3:</label>
      <select id="rotor-3" name="rotor-3">
        <option value="1">I</option>
        <option value="2">II</option>
        <option value="3" selected>III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
      </select>&nbsp;&nbsp;
      <label for="initial-3">Setting:</label>
      <input class="initial" id="initial-3" name="initial-3" type="text" value="A">
    </p>
    <p><input type="submit" name="set" value="Set"> <input type="submit" name="cancel" value="Cancel"></p></form>
</div>
<footer>
  <p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
</footer>
</body>
</html>
