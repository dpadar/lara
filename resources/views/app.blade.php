<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lara</title>
</head>
<body>
	<div id="app"></div>
	<script>
		window.auth_user = {!! Auth::check() ? json_encode(Auth::user()) : null !!};
	</script>
	<script src="js/app.js"></script>
</body>
</html>