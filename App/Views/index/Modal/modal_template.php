<!-- modal_template.php -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel"></h5>
            </div>
            <div class="modal-body">
                <p id="errorModalMessage"></p>
            </div>
        </div>
    </div>
</div>

<script>

    function showModal(title, message, modalClass){
        $('#errorModalLabel').text(title).css('font-weight', 'bold');
        $('#errorModalMessage').text(message);
        
        // Limpar classes existentes e adicionar as novas
        $('#errorModal .modal-header').removeClass().addClass('modal-header text-white ' + modalClass);
        $('#errorModal .modal-title').removeClass().addClass('modal-title ' + modalClass);

        $('#errorModal').modal('show');
    }
</script>
