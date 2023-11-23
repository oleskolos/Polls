<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="modal" id="myModal" tabindex="-1" role="dialog" ng-controller="cabinetController">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Poll "{{ capitalize(pollName) }}"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div ng-repeat="option in optionNames">
            <b>{{ option.name }}</b>: {{ option.votes !== null ? option.votes : 0 }} votes
        </div>
        <br>
        <p><b>Status</b>: {{ pollStatus }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $("#myModal").modal('show');
  });
</script>

</body>
</html>