<div class="modal-header"><h4 class="modal-title"><i class="fa fa-bug"></i> Log de Erro</h4></div>

<div class="modal-body clearfix">
    <div class="form-group clearfix">
        <div class="col-sm-6">
            <label>Data</label>
            <input type="text" class="form-control" value="{{ $log->date->format('d/m/Y') }}" disabled />
        </div>

        <div class="col-sm-6">
            <label>Tipo</label>
            <input type="text" class="form-control" value="{{ ucfirst($log->level) }}" disabled />
        </div>
    </div>

    <?php
        $log->message = str_replace('Stack trace: ', '<br/><strong>Stack trace:</strong>', $log->message);
        $log->message = str_replace('#', '<br/>#', $log->message);
        $log->message = nl2br($log->message);
    ?>
    <div class="form-group clearfix">
        <div class="col-sm-12">
            <label>Ocorrência</label>
            <div class="well">{{ raw:$log->message }}</div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
</div>