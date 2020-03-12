@section('sidebar')
<!-- <div class="container-fluid">
    <div class="row"> -->
        <?php
        if( $_SERVER['PHP_SELF'] != '/yopla_mockup/index.php') { ?>
        <nav class=" d-none d-md-block bg-light sidebar">               
            <div class="sidebar-sticky">
                <ul id="Software" class="nav flex-column">
                    <li class="nav-item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
                    <li class="nav-item"><a href="/stundenplanung/show.php"><i class="fa fa-id-badge"></i> Stundenplanung</a>
                        <ul>
                            <li><a href="/stundenplanung/new.php">neue Stunde planen</a></li>
                            <li><a href="/stundenplanung/show.php">Alle anzeigen</a></li>
                        </ul></li>
                    <li class="nav-item"><a href="/konzept.php"><i class="fa fa-list-alt"></i> Konzept</a>
                        <ul>
                            <li><a href="">Neues Konzept erstellen</a></li>
                            <li><a href="">Alle Konzepte anzeigen</a></li>
                        </ul></li>
                    <li class="nav-item"><a href="/asana.php"><i class="fa fa-odnoklassniki"></i> Asanas</a>
                        <ul>
                            <li><a href="">Alle Asanas anzeigen</a></li>
                            <li><a href="">Asana erstellen</a></li>
                        </ul></li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">Rechtliches</h6>
                <ul id="account" class="nav flex-column">
                    <li class="nav-item"><a href="/account.php">Login</a></li>
                    <li class="nav-item"><a href="/pricing.php">Preis</a></li>
                    <li class="nav-item"><a href="/impressum.php">Impressum</a></li>
                    <li class="nav-item"><a href="/datenschutz.php">Datenschutz</a></li>
                </ul>
             </div>
        </nav>
        <!-- <section class="col-md-9 ml-sm-auto"> -->
    <?php } else { ?>
                <aside class="col-sm-4 mx-auto">
<div class="card">
<article class="card-body">
    <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
    <hr>
    <p class="text-success text-center">Some message goes here</p>
    <form action="<?php echo $path; ?>dashboard.php">
    <div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
         </div>
        <input name="" class="form-control" placeholder="Email or login" type="email">
    </div> <!-- input-group.// -->
    </div> <!-- form-group// -->
    <div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
         </div>
        <input class="form-control" placeholder="******" type="password">
    </div> <!-- input-group.// -->
    </div> <!-- form-group// -->
    <div class="form-group">
    <button type="submit" class="btn btn-primary btn-block"> Login  </button>
    </div> <!-- form-group// -->
    <p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
    </form>
</article>
</div> <!-- card.// -->

    </aside> <!-- col.// -->    
<?php } ?>
@stop