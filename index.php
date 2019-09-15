<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DOT'S AP - Foglio Appuntamenti</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">

  <!-- Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#"><i class="fas fa-user-md"></i> DOT'S AP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link active " href="/dotsap/">
        Home
      </a>
    </li>
  </ul>
</div>
  </nav>

  <main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-5">Fogli Appuntamenti</h1>
        </div>
    </div>

    <div class="container">
        <h2>Dott.ssa Rollandin</h2>
        <div class="row">
            <div class="col-md-12"> 
                <?php
                    $oggi = new DateTime();
                    $listaGiorni = array();

                    $giorno_settimana_numero = $oggi->format('N');
                    $differenzagiornilunedi = $giorno_settimana_numero - 1;
                    $lunedi = clone $oggi;
                    $lunedi->sub(new DateInterval("P" . $differenzagiornilunedi . "D"));

                    for($c = 0; $c<6; $c++) {
                        $listaGiorni[] = clone $lunedi;
                        $lunedi->add(new \DateInterval('P7D'));
                    }                    
                ?>

                <?php foreach($listaGiorni as $g): ?>
                    <a href="foglioapp.php?data=<?= $g->format('Y-m-d'); ?>&dott=rollandin">Settimana dal <?= $g->format('Y-m-d'); ?></a><br>
                <?php endforeach; ?>
                <br>
                <h5>Due settimane sullo stesso foglio: </h5>
                <?php for($c = 0; $c<6; $c+=2) : ?>
                    <a href="foglioapp.php?data=<?= $listaGiorni[$c]->format('Y-m-d'); ?>&dott=rollandin2">Settimana dal <?= $listaGiorni[$c]->format('Y-m-d'); ?></a><br>
                <?php endfor; ?>
            </div>
        </div>
        <hr>
        <h2>Dott.ssa Cavurina</h2>
        <div class="row">
            <div class="col-md-12"> 
                <?php foreach($listaGiorni as $g): ?>
                    <a href="foglioapp.php?data=<?= $g->format('Y-m-d'); ?>&dott=cavurina">Settimana dal <?= $g->format('Y-m-d'); ?></a><br>
                <?php endforeach; ?>
            </div>
        </div>
        <hr>
    </div> <!-- /container -->
  </main>

  <footer class="container">
    <p>&copy; Studio Archistico 2017-<?= (new DateTime())->format('Y'); ?></p>
  </footer>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>
</html>
