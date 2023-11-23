<style>
    .modal {
    opacity: 1; 
    background: rgba(0, 0, 0, 0.3);
}
.modal-dialog {
    top: 250px;
}

</style>


<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Poll "{{ capitalize(pollName) }}"</h4>
    </div>
    <div class="modal-body">
        <form>
            <input type="hidden" data-ng-model="pollId" name="pollId">
            <div class="form-group">
                <label>Name of poll</label>
                <input type="text" data-ng-model="pollName" name="pollName" class="form-control">
            </div>

            <!-- Loop through option_names and create input fields for each option -->
            <div class="form-group" data-ng-repeat="(index, option) in optionNames" data-ng-init="option.votes = option.votes || 0">
                <label for="optionName{{index}}">Option {{index + 1}} name:</label>
                <input type="text" data-ng-model="option.name" name="optionName" class="form-control" placeholder="Option Name">
                <br>
                <label for="optionVotes{{index}}">Option {{index + 1}} votes:</label>
                <input type="text" data-ng-model="option.votes" name="optionVotes" class="form-control" placeholder="Votes">
            </div>

            <div class="form-group">
                <input type="text" data-ng-model="pollStatus" name="pollStatus" class="form-control">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-ng-click="close();">Close</button>
        <button type="button" class="btn btn-primary" data-ng-click="save()">Save</button>
    </div>
</div>




