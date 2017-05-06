<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://slimapp.dev/inventors')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


// Get All inventors
$app->get('/api/inventors', function(Request $request, Response $response){
    $sql = "SELECT * FROM inventors";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $inventors = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($inventors);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Get Single Inventor
$app->get('/api/inventor/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM inventors WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $Inventor = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($Inventor);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Add Inventor
$app->post('/api/inventor/add', function(Request $request, Response $response){
    $firstname = $request->getParam('firstname');
    $lastname = $request->getParam('lastname');
    $bio = $request->getParam('bio');
    $invention_date = $request->getParam('invention_date');
    $homepage_date = $request->getParam('homepage_date');

    $sql = "INSERT INTO inventors (firstname,lastname,bio,invention_date,homepage_date) VALUES
    (:firstname,:lastname,:bio,:invention_date,:homepage_date)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname',  $lastname);
        $stmt->bindParam(':bio',      $bio);
        $stmt->bindParam(':invention_date',      $invention_date);
        $stmt->bindParam(':homepage_date',    $homepage_date);

        $stmt->execute();

        echo '{"notice": {"text": "Inventor Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Update Inventor
$app->put('/api/inventor/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $firstname = $request->getParam('firstname');
    $lastname = $request->getParam('lastname');
    $bio = $request->getParam('bio');
    $invention_date = $request->getParam('invention_date');
    $homepage_date = $request->getParam('homepage_date');

    $sql = "UPDATE inventors SET
				firstname 	= :firstname,
				lastname 	= :lastname,
                bio		= :bio,
                invention_date		= :invention_date,
                homepage_date 	= :homepage_date

			WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname',  $lastname);
        $stmt->bindParam(':bio',      $bio);
        $stmt->bindParam(':invention_date',      $invention_date);
        $stmt->bindParam(':homepage_date',    $homepage_date);

        $stmt->execute();

        echo '{"notice": {"text": "Inventor Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Delete Inventor
$app->delete('/api/inventor/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM inventors WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->execute();

        $db = null;
        echo '{"notice": {"text": "Inventor Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
