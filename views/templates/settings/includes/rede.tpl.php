<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label" title="{{ $i18n->get('app::tooltips.desativar-pagamento-rede') }}">{{ $i18n->get('ui.columns.desativar-pagamento-rede') }}</label>
    <div class="col-sm-10">
        <select name="settings[desativar_pagamento_rede]" class="form-control">
            <option value="0" {% if($setting->get('desativar_pagamento_rede') == 0) %}selected{% endif %}>Não</option>
            <option value="1" {% if($setting->get('desativar_pagamento_rede') == 1) %}selected{% endif %}>Sim</option>
        </select>
    </div>
</div>