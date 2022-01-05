{% extends:'mako-janitor::base' %}

{% block:title %}<i class="fa fa-fw fa-cogs"></i> Configurações{% endblock %}

{% block:content %}
<div class="form-panel">
    <form class="form-horizontal style-form" method="POST" action="settings/update/">
        <ul class="nav nav-tabs nav-metro" role="tablist">
            <li role="presentation" class="active">
                <a href="#general" aria-controls="general" role="tab" data-toggle="pill"><i class="fa fa-database"></i> {{ $i18n->get('ui.strings.geral') }}</a>
            </li>
            <li role="presentation">
                <a href="#rede" aria-controls="rede" role="tab" data-toggle="pill"><i class="fa fa-sitemap"></i> {{ $i18n->get('ui.strings.rede-e-comissoes') }}</a>
            </li>
            <li role="presentation">
                <a href="#emails" aria-controls="emails" role="tab" data-toggle="pill"><i class="fa fa-envelope"></i> {{ $i18n->get('ui.strings.emails') }}</a>
            </li>
            <li role="presentation">
                <a href="#redirecionamentos" aria-controls="redirecionamentos" role="tab" data-toggle="pill"><i class="fa fa-magnet"></i> {{ $i18n->get('ui.strings.redirecionamentos') }}</a>
            </li>
            <li role="presentation">
                <a href="#cronjobs" aria-controls="cronjobs" role="tab" data-toggle="pill"><i class="fa fa-clock-o"></i> {{ $i18n->get('ui.strings.cronjobs') }}</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="general">{{ view:'mako-janitor::templates.settings.includes.general' }}</div>

            <div role="tabpanel" class="tab-pane" id="rede">{{ view:'mako-janitor::templates.settings.includes.rede' }}</div>

            <div role="tabpanel" class="tab-pane" id="emails">{{ view:'mako-janitor::templates.settings.includes.emails' }}</div>

            <div role="tabpanel" class="tab-pane" id="redirecionamentos">{{ view:'mako-janitor::templates.settings.includes.redirecionamentos' }}</div>

            <div role="tabpanel" class="tab-pane" id="cronjobs">{{ view:'mako-janitor::templates.settings.includes.cronjobs' }}</div>
        </div>

        <button id="save-settings" type="button" class="btn btn-md btn-success"><i class="fa fa-save"></i> Salvar</button>
    </form>
</div>
{% endblock %}

{% block:scripts %}
    <script type="text/javascript">
        $(document).on('click', '#save-settings', function(event) {

            // Disable button
            $('#save-settings').html('<i class="fa fa-spinner"></i> Processando...').attr('disabled', 'disabled');

            // Form data
            var data = $(this).parent('form').serialize();

            // Form action
            var action = $(this).parent('form').attr('action');

            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(data) {
                    if (data.status == 'success') {
                        $('#save-settings').html('<i class="fa fa-check-circle"></i> Sucesso!');

                        setTimeout(function() {
                            $('#save-settings').html('<i class="fa fa-save"></i> Salvar').attr('disabled', false);
                        }, 600);
                    }
                }
            });
        });

        // Add redir
        $(document).on('click', '#redirecionamentos tfoot .btn', function() {

            // Capturar ultimo indice
            var lastIndex = $('#redirecionamentos tbody tr:last').index() + 1;

            // Criar HTML
            var html  = '<tr>';
                    html += '<td><input type="text" name="settings[redirecionamentos][' + lastIndex + '][origem]" class="form-control"></td>';
                    html += '<td><input type="text" name="settings[redirecionamentos][' + lastIndex + '][destino]" class="form-control"></td>';
                    html += '<td class="text-center"><button type="button" class="btn btn-warning btn-sm btn-block"><i class="fa fa-fw fa-trash-o"></i></button></td>';
                html += '</tr>';

            // Adicionar linha
            $('#redirecionamentos tbody').append(html);
        });

        // Deletar redir
        $(document).on('click', '#redirecionamentos tbody .btn', function() {

            var button = $(this);

             bootbox.dialog({
                message: '{{ $i18n->get("ui.strings.confirm-delete-item") }}',
                title: '{{ $i18n->get("ui.actions.delete") }}',
                buttons: {
                    danger: {
                        label: '<i class="fa fa-undo"></i> {{ $i18n->get("ui.actions.cancelar") }}',
                        className: "btn-danger",
                        callback: function() { }
                    },
                    main: {
                        label: '<i class="fa fa-check"></i> Sim',
                        className: "btn-primary",
                        callback: function() {
                            button.parent().parent().remove();
                        }
                    }
                }
            });
        });
    </script>
{% endblock %}