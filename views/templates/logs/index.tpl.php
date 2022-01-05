{% extends:'mako-janitor::base' %}

{% block:title %}
    <i class="fa fa-bug"></i> Logs do Sistema
    <a href="logs/clear/" class="btn btn-primary dialog-confirm-url pull-right mr" style="margin-bottom:10px;"><i class="fa fa-trash-o"></i> Limpar Logs</a>
{% endblock %}

{% block:content %}
    <div class="content-panel clearfix">
        <table class="table">
            <thead>
                <th width="70">Cód.</th>
                <th width="160">Data</th>
                <th width="120">Tipo</th>
                <th>Ocorrência</th>
                <th width="180">Ação</th>
            </thead>
            <tbody>
                {% foreach($logs as $id => $value) %}
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $value->date->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($value->level) }}</td>
                    <td>{{ \mako\utility\Str::limitChars($value->message, 120) }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="logs/read/{{ $id }}" class="btn btn-info" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-search"></i> Ver</a>

                            <a href="logs/delete/{{ $id }}" class="btn btn-danger dialog-confirm-url"><i class="fa fa-trash"></i> Deletar</a>
                        </div>
                    </td>
                </tr>
                {% endforeach %}
            </tbody>
        </table>
    </div>
{% endblock %}