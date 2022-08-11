<!--    Call API-->
<?php
$endpoint = 'everything?';
$keyword = 'latest';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
//    $endpoint = 'top-headlines?';
}

$curl = curl_init();
//$ApiKey = '75fd580f046a4d8aafdb04a4023170ec';
$url = "https://newsapi.org/v2/" . $endpoint . "q=" . $keyword . "&apiKey=75fd580f046a4d8aafdb04a4023170ec";
echo $url;
// set our url with curl_setopt()
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
    ),
));

// curl_exec() executes the started curl session
// $output contains the output string
$output = json_decode(curl_exec($curl));

// close curl resource to free up system resources
// (deletes the variable made by curl_init)
curl_close($curl);

?>
<!--    Cognitive TTS-->
<?php
////RESOURCE
//$key = '5ae0b9cac26d4af8b943e3ddb29ac5ea';
//$headers = array([
//    'Ocp-Apim-Subscription-Key' => $key,
//]);
//
////create cUrl resource
//$curl = curl_init();
//
//curl_setopt_array($curl, array(
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_URL => 'https://eastasia.api.cognitive.microsoft.com/sts/v1.0/issuetoken',
//    CURLOPT_POST => 0,
//    CURLOPT_HTTPHEADER => $headers,
//));
//
//$res = curl_exec($curl);
//$token = json_decode($res);
//echo '<pre>';
//var_dump($token);
//die();
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>News Web</title>
</head>
<body>
<!--    NAVBAR-->
<nav class="navbar navbar-dark bg-primary shadow">
    <div class="container-fluid justify-content-center">
        <a class="navbar-brand" href="#">
            <img src="assets/images/icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <b> NewsUsingAPI</b>
        </a>
    </div>
</nav>
<!-- -->

<!--    SEARCH BAR-->

<div class="container mt-5">
    <div class="d-flex justify-content-center mb-3">
        <img src="assets/images/icon.png" width="150px" alt="#404">
    </div>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
        <div class="col-12 d-flex justify-content-center">
            <div class="input-group mb-3" style="width: 50%;transform: scale(1.3);">
                <input type="text" class="form-control shadow" name="keyword" placeholder="What you looking for ?"
                       aria-label="Recipient's username" aria-describedby="button-addon2" formmethod="get">
                <button class="btn btn-danger shadow" type="submit" id="button-addon2">Search</button>
            </div>
        </div>
    </form>

</div>
<!--    CONTENT SECTION-->
<div class="container">
    <!--    LOADING'S SPINNER-->
    <!--    <div class="d-flex justify-content-center">-->
    <!--        <div class="spinner-border" id = "load_ui" role="status">-->
    <!--            <span class="visually-hidden">Loading...</span>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--    ARTICLES-->
    <?php if ($output->totalResults > 0): ?>
        <?php foreach ($output->articles as $article): ?>
            <div class="card m-3 shadow">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= $article->urlToImage ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article->title ?></h5>
                            <p class="card-text"><?= $article->description ?></p>
                            <p class="card-text"><small
                                        class="text-muted"><?php echo date('F j, Y, g:i a', strtotime($article->publishedAt)) ?></small>
                            </p>
                            <a href="<?= $article->url ?>" target="_blank" class="btn btn-secondary">Read More</a>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="d-flex justify-content-center mb-3">
            <img class="img-fluid" src="assets/images/no_results_found.webp" width="700px" alt="#404">
        </div>
    <?php endif; ?>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
</script>

</body>
</html>

