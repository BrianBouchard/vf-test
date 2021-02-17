<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
//use \Firebase\JWT\JWT\;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../lib/environment.php';
require __DIR__ . '/../lib/mysql.php';
//require __DIR__ . '/../lib/brianmw.php';


$app = AppFactory::create();

//Middleware goes here
//$decoded_token = JWT::decode(str_replace('Bearer ', '', $_SERVER['Authorization']), getenv('HASHED_TOKEN_VALUE'), ['HS256']);
//I can't get JWT installed for some weird reason. I promise I know what's going on there! Code examples in Node.js will be provided upon request.
//It seems I can't get any middleware to work. Please note that I've never used slim before. I understand the concept but I'm just having a hard time implementing it.

//$app->add(new BrianMWHeaderXdayAdd());

//Routing
$app->get('/index.php', function ($request, $response, $args) {
	$db = connect_db();

	$result = $db->query("SELECT * FROM vf_widgets");
	while ($row = $result->fetch_array(MYSQLI_ASSOC))
	{
		$data[] = $row;
	}

	$response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
	return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/index.php', function ($request, $response, $args) {
	$db = connect_db();

        $contentType = $request->getHeaderLine('Content-Type');
	if (strstr($contentType, 'application/json'))
        {
		$data = json_decode(file_get_contents('php://input'), true);
        }

	//Insert widgets if they pass muster (Name not blank, 20 char limit, description 100 char limit)
	foreach($data as $widget)
	{
		if(strlen($widget['Name']) > 0 && strlen($widget['Name']) <= 20 && strlen($widget['Description']) <= 100) 
		{
			$stmt = $db->prepare("INSERT INTO vf_widgets (Name, Description) VALUES (?, ?)");
			$stmt->bind_param("ss", $widget['Name'], $widget['Description']);

			if (!$stmt->execute())
			{
				var_dump($db->error);
			}
			$stmt->close();
		}
		else
		{
			//Does not pass muster, fail gracefully
			$response_message['Message'] = "Invalid data presented";
			$response->getBody()->write(json_encode($response_message, JSON_PRETTY_PRINT));
			return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
		}
	}

	$response_message['Message'] = "Widget(s) added successfully";
	$response->getBody()->write(json_encode($response_message, JSON_PRETTY_PRINT));
	return $response->withHeader('Content-Type', 'application/json');
});

$app->patch('/index.php', function ($request, $response, $args) {
	$db = connect_db();

        $contentType = $request->getHeaderLine('Content-Type');
	if (strstr($contentType, 'application/json'))
        {
		$data = json_decode(file_get_contents('php://input'), true);
        }

	//Update widgets if they pass muster (Name not blank, 20 char limit, description 100 char limit)
	foreach($data as $widget)
	{
		if(strlen($widget['Name']) > 0 && strlen($widget['Name']) <= 20 && strlen($widget['Description']) <= 100) 
		{
			$stmt = $db->prepare("UPDATE vf_widgets SET Name = ?, Description = ? WHERE ID = ?");
			$stmt->bind_param("ssi", $widget['Name'], $widget['Description'], $widget['ID']);

			if (!$stmt->execute())
			{
				var_dump($db->error);
			}
			$stmt->close();
		}
		else
		{
			//Does not pass muster, fail gracefully
			$response_message['Message'] = "Invalid data presented";
			$response->getBody()->write(json_encode($response_message, JSON_PRETTY_PRINT));
			return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
		}
	}

	$response_message['Message'] = "Widget(s) updated successfully";
	$response->getBody()->write(json_encode($response_message, JSON_PRETTY_PRINT));
	return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/index.php', function ($request, $response, $args) {
	$db = connect_db();

        $contentType = $request->getHeaderLine('Content-Type');
	if (strstr($contentType, 'application/json'))
        {
		$data = json_decode(file_get_contents('php://input'), true);
        }

	foreach($data as $widget)
	{
		$stmt = $db->prepare("DELETE FROM vf_widgets WHERE ID = ?");
		$stmt->bind_param("i", $widget['ID']);

		if (!$stmt->execute())
		{
			var_dump($db->error);
		}
		$stmt->close();
	}

	$response_message['Message'] = "Widget(s) removed successfully";
	$response->getBody()->write(json_encode($response_message, JSON_PRETTY_PRINT));
	return $response->withHeader('Content-Type', 'application/json');
});

/*
//Catch all other requests
$response_message['Message'] = "Page Not Found";
$response->getBody()->write(json_encode($response_message, JSON_PRETTY_PRINT));
return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
*/
$app->run();


