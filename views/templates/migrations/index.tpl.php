{% extends:'mako-janitor::base' %}

{% block:title %}
    <i class="fa fa-database"></i> Migrations
{% endblock %}

{% block:content %}
    {% if ($hasPendingMigrations) %}
        <div class="darkblue-panel pn">
            <div class="darkblue-header">
                <h5>Banco de Dados</h5>
            </div>
            <h1><i class="fa fa-wrench fa-3x"></i></h1>
            <p class="mt">É necessário fazer algumas atualizações no banco de dados.</p>
            <footer>
                <div class="centered">
                    <a href="migrations/up/"><h5><i class="fa fa-check-circle"></i> Ok, Aplicar Atualizações</h5></a>
                </div>
            </footer>
        </div>
    {% endif %}

    <div class="content-panel clearfix">
        <table class="table">
            <thead>
                <th width="140">Data</th>
                <th width="80">Status</th>
                <th>Descrição</th>
            </thead>
            <tbody>
                {% foreach($migrations as $value) %}
                <tr>
                    <td>{{ $value->date->format('d/m/Y H:i:s') }}</td>
                    <td>
                        {% if($value->status) %}
                            <span class="label label-success">Aplicada</span>
                        {% else %}
                            <span class="label label-danger">Pendente</span>
                        {% endif %}
                    </td>
                    <td>{{ $value->description }}</td>
                </tr>
                {% endforeach %}
            </tbody>
        </table>
    </div>
{% endblock %}