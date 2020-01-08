<div id="exampleModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Guild Points (<span id="points-guildName"></span><span id="points-guildId" class="d-none"></span> - <span id="points-amount"></span> point(s))</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="points-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason">Reason for point change:</label>
                        <textarea id="points-reason" class="form-control" name="reason" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="points-save" type="button" class="btn btn-primary">Save changes</button>
                    <div id="points-spinner" class="spinner-border" style="display: none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget); // Button that triggered the modal
            var amount = button.data('amount'); // Extract info from data-* attributes
            var guildId = button.data('guild');
            var guildName = button.data('guildname');

            $('#points-guildName').text(guildName);
            $('#points-guildId').text(guildId);
            $('#points-amount').text(amount);
        });
    });


    $('#points-save').on('click', function(e) {
        var guildId = parseInt($('#points-guildId').text());
        var amount = parseInt($('#points-amount').text());
        var reason = $('#points-reason').val();
        updatePoints(guildId, amount, reason);
    });

    function updatePoints (guildId, points, reason) {
        var pointsField = $('#guild-points-' + guildId);
        var currentPoints = pointsField.text();
        var updatedPoints = parseInt(currentPoints) + points;

        $('#points-save').hide();
        $('#points-spinner').show();

        if (reason !== "") {
            axios.post('/guilds/' + guildId, {
                data: {
                    "points": updatedPoints
                },
                _method: 'put'
            }).then(function (response) {
                pointsField.text(updatedPoints);
            }).catch(function (error) {
                console.log(error.response.data);
            }).then(function() {
                $('#exampleModal').modal('hide');
                $('#points-save').show();
                $('#points-spinner').hide();
            });
        } else {
            $('#points-save').show();
            $('#points-spinner').hide();
            alert('A reason must be given for adding / removing points');
        }
    }
</script>
@endpush