<?php
// Query apptrackr easily, mainly for me while i debug stuffz
namespace apptrackr;

require_once(__DIR__ . "/apptrackr.inc.php");

use apptrackr\request\GenericRequest;
use apptrackr\credentials\ApptrackrCredentials;

if (!$_POST["submit"]) {
	?>
	<html>
		<body>
			<form action="" method="post">
				Object: <input type="text" name="object" /><br />
				Action: <input type="text" name="action" /><br />
				Username: <input type="text" name="username" /><br />
				Password: <input type="password" name="password" /><br />
				Arg1: <input type="text" name="arg1name" />: <input type="text" name="arg1" /><br />
				Arg2: <input type="text" name="arg2name" />: <input type="text" name="arg2" /><br />
				Arg3: <input type="text" name="arg3name" />: <input type="text" name="arg3" /><br />
				Arg4: <input type="text" name="arg4name" />: <input type="text" name="arg4" /><br />
				<input type="submit" name="submit" value="submit" />
			</form>
		</body>
	</html>
	<?php
	die();
}

$r = new GenericRequest;

if ($_POST["username"] && $_POST["password"]) {
	$ac = new ApptrackrCredentails;
	$ac->username = $_POST["username"];
	$ac->password = $_POST["password"];
	$r->apptrackrCredentials = $ac;
}

$r->objectName = $_POST["object"];
$r->actionName = $_POST["action"];

for ($i=1;$i<5;$i++) {
	if ($_POST["arg" . $i . "name"] && $_POST["arg" . $i]) {
		$r->args[$_POST["arg" . $i . "name"]] = $_POST["arg" . $i];
	}
}

$r->sendRequest();

print_r($r);
?>