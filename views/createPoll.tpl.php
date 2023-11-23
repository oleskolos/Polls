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
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Creating new poll</a>
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

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" ng-app="addPoll" ng-controller="addPoll">
    <h1 class="h2">Create poll</h1>
    <form id="addPollForm" method="POST">
        <div class="form-group">
            <label for="name">Poll Name:</label>
            <input type="text" class="form-control" name="name" ng-model="newPollName" required>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="status" ng-model="newPollStatus" value="2">
            <label class="form-check-label" for="status">Publish poll</label>
        </div>

        <div class="form-group">
            <label for="options">Number of Options:</label>
            <input id="pollOptionInput" type="number" class="form-control" ng-model="numOptions" min="1" required>
        </div>

        <button type="button" class="btn btn-primary mb-3" ng-click="addOptions()">Add Options</button><br>

        <h3>Poll Options</h3>

        <div ng-if="options.length > 0" ng-repeat="option in options track by $index">
            <div class="form-group">
                <label for="optionName{{$index}}">Option Name:</label>
                <input type="text" class="form-control" ng-model="option.name" required>
            </div>

            <div class="form-group">
                <label for="optionVotes{{$index}}">Number of Votes:</label>
                <input type="number" class="form-control" ng-model="option.votes" min="0">
            </div>
        </div>

        <button type="button" ng-click="addPoll()" class="btn btn-success mt-3">Add poll</button>
    </form>
</main>

      </div>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <!-- <script src="/js/angular-route.js"></script> -->
    <script src="/js/admin/addPoll.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>

    <!-- Icons -->
    <script src="/js/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
