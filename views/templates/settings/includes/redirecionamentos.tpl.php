<div class="table-responsive">
    <input type="hidden" name="settings[redirecionamentos][-1][origem]" value="">
    <input type="hidden" name="settings[redirecionamentos][-1][destino]" value="">

    <table id="redirecionamentos" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <td>{{ $i18n->get('ui.columns.origem') }}</td>
                <td>{{ $i18n->get('ui.columns.destino') }}</td>
                <td class="text-center" style="width:70px;">{{ $i18n->get('ui.columns.acoes') }}</td>
            </tr>
        </thead>
        <tbody>
            {% foreach($setting->get('redirecionamentos', []) as $rKey => $redir) %}
                {% if($rKey >= 0) %}
                    <tr>
                        <td><input type="text" name="settings[redirecionamentos][{{ $rKey }}][origem]" value="{{ Arr::get($redir, 'origem') }}" class="form-control"></td>
                        <td><input type="text" name="settings[redirecionamentos][{{ $rKey }}][destino]" value="{{ Arr::get($redir, 'destino') }}" class="form-control"></td>
                        <td class="text-center"><button type="button" class="btn btn-warning btn-sm btn-block"><i class="fa fa-fw fa-trash-o"></i></button></td>
                    </tr>
                {% endif %}
            {% endforeach %}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td class="text-center"><button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus-circle"></i></button></td>
            </tr>
        </tfoot>
    </table>
</div>