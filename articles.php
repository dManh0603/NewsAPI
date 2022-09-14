<?php
$endpoint = 'everything?';
$keyword = 'latest';
if (!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
//    $endpoint = 'top-headlines?';
}
$curl = curl_init();
//$ApiKey = '75fd580f046a4d8aafdb04a4023170ec';
$url = "https://newsapi.org/v2/" . $endpoint . "q=" . $keyword . "&apiKey=75fd580f046a4d8aafdb04a4023170ec";

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

<?php if (isset($output->totalResults) && $output->totalResults > 0): ?>
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
