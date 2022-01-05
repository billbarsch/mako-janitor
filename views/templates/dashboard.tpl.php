{% extends:'mako-janitor::base' %}

{% block:title %}<i class="fa fa-fw fa-dashboard"></i> Dashboard{% endblock %}

{% block:content %}
<div class="row">
    <div class="col col-sm-6">

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
        {% else %}
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>Banco de Dados</h5>
                </div>
                <h1><i class="fa fa-database fa-3x"></i></h1>
                <p class="mt">Todas as atualizações do banco de dados foram aplicadas!</p>
                <footer>
                    <div class="centered">
                        <a href="migrations"><h5><i class="fa fa-check-circle"></i> Ver Todas Atualizações</h5></a>
                    </div>
                </footer>
            </div>
        {% endif %}

        <div class="content-panel mt" style="min-height:352px;">
            <h4><i class="fa fa-database"></i> Últimas Atualizações</h4>

            <table class="table">
                <thead>
                    <th width="140">Data</th>
                    <th width="80">Status</th>
                    <th>Descrição</th>
                </thead>
                <tbody>
                    {% foreach($lastMigrations as $value) %}
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
    </div>

    <div class="col col-sm-6">
        <div class="content-panel">
            <h4><i class="fa fa-bug"></i> Últimos registros de erro <a href="logs" class="pull-right mr"><i class="fa fa-search"></i> Ver Todos</a></h4>

            <div class="clearfix" style="height:404px;overflow-y:scroll;">
                <table class="table">
                    <thead>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Ocorrência</th>
                        <th>Ação</th>
                    </thead>
                    <tbody>
                        {% foreach($lastLogs as $key => $value) %}
                        <tr>
                            <td>{{ $value->date->format('d/m/Y H:i:s') }}</td>
                            <td>{{ ucfirst($value->level) }}</td>
                            <td>{{ \mako\utility\Str::limitChars($value->message, 50) }}</td>
                            <td>
                                <a href="logs/read/{{ $key }}" class="btn btn-info" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-search"></i></a>

                                <a href="logs/delete/{{ $key }}" class="btn btn-danger dialog-confirm-url"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        {% endforeach %}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-panel" style="margin:15px 0px;">
            <h4 class="mb"><i class="fa fa-key"></i> Gerar nova senha</h4>
            <form class="form-inline" role="form">
                <div class="form-group pull-left mr" style="width:40%;">
                    <label class="sr-only">Digite sua senha</label>
                    <input type="password" name="new_password" class="form-control" style="width:100%;" placeholder="Digite sua senha" />
                </div>

                <button type="button" id="crypt-password" class="btn btn-info pull-left mr">Gerar</button>

                <div class="form-group" style="width:100%;margin-top:8px;">
                    <label class="sr-only">Senha criptografada</label>
                    <input type="text" name="encrypted_password" class="form-control" style="width:100%;" placeholder="Senha criptografada" readonly />
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}

{% block:scripts %}
    <script type="text/javascript">
        $(document).on('click', '#crypt-password', function(event) {
            $.ajax({
                url: 'crypt-password/',
                type: 'POST',
                dataType: 'json',
                data: {password : $('input[name="new_password"]').val()},
                success: function(data) {
                    if (data.status == 'success') {
                        $('input[name="encrypted_password"]').val('Nova senha salva com sucesso!');
                    }
                }
            });
        });
    </script>
{% endblock %}