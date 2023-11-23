<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" sizes="196x196" href="/images/favicon.ico">
    <title><?php echo $pageData['title'] ?></title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fonts/css/fontawesome.min.css">
    <link href="/css/dashboard.css" rel="stylesheet">


    <base href="/cabinet/">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?php echo $pageData['currentUserLogin']; ?> Personal Cabinet</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="/cabinet/logout">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/cabinet">
                  <span data-feather="home"></span>
                  My polls <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/cabinet/createPoll">
                  <span data-feather="layers"></span>
                  Create poll
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" data-ng-app="cabinet" data-ng-controller="cabinetController">
          <h1 class="h2">My polls</h1>
          <div data-ng-view></div>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Options</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($pageData['polls'] as $key => $value) : ?>
                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><a data-ng-click="getInfoByPollId(<?php echo $value['id']; ?>)" href="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
                    <td><?php echo $value['options']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                    <td><a ng-click="open(<?php echo $value['id']; ?>)" role="button" aria-expanded="true" aria-controls="collapseOne">
                                                    edit
                                                    </a>
                                                    <a ng-click="deletePoll(<?php echo $value['id']; ?>)">
                                                    delete
                                                    </a>
                    </td>                              
                                                   
                </tr>
            <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

  

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/angular-route.js"></script>
    <script src="/js/admin/app.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.min.js"></script> -->


    <!-- Icons -->
    <script src="/js/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
