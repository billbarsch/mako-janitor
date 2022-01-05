<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Forçar SSL</label>
    <div class="col-sm-10">
        <select name="settings[force_ssl]" class="form-control">
            <option value="0" {% if($setting->get('force_ssl') == 0) %}selected{% endif %}>Não</option>
            <option value="1" {% if($setting->get('force_ssl') == 1) %}selected{% endif %}>Sim</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Comissão de Faturamento</label>
    <div class="col-sm-10">
        <input type="text" name="settings[revenue_comission]" value="{{ $setting->get('revenue_comission') }}" class="form-control">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Dia do Vencimento</label>
    <div class="col-sm-10">
        <input type="text" name="settings[dia_vencimento]" value="{{ $setting->get('dia_vencimento') }}" class="form-control" placeholder="Ex.: 31/12/2018">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Prazo de Bloqueio</label>
    <div class="col-sm-10">
        <input type="text" name="settings[prazo_bloqueio_pagamento]" value="{{ $setting->get('prazo_bloqueio_pagamento') }}" class="form-control">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Desabilitar Admin</label>
    <div class="col-sm-10">
        <select name="settings[disable_admin]" class="form-control">
            <option value="0" {% if($setting->get('disable_admin') == 0) %}selected{% endif %}>Não</option>
            <option value="1" {% if($setting->get('disable_admin') == 1) %}selected{% endif %}>Sim</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Desabilitar Backoffice</label>
    <div class="col-sm-10">
        <select name="settings[disable_backoffice]" class="form-control">
            <option value="0" {% if($setting->get('disable_backoffice') == 0) %}selected{% endif %}>Não</option>
            <option value="1" {% if($setting->get('disable_backoffice') == 1) %}selected{% endif %}>Sim</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Desabilitar Site</label>
    <div class="col-sm-10">
        <select name="settings[disable_site]" class="form-control">
            <option value="0" {% if($setting->get('disable_site') == 0) %}selected{% endif %}>Não</option>
            <option value="1" {% if($setting->get('disable_site') == 1) %}selected{% endif %}>Sim</option>
        </select>
    </div>
</div>

<?php $languages = $setting->get('languages', ['pt_BR']); ?>
<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label" data-toggle="tooltip-left" title="{{ $i18n->get('app::tooltips.idiomas') }}">{{ $i18n->get('ui.columns.idiomas') }}</label>
    <div class="col-sm-10">
        <div class="checkbox">
            <label><input type="checkbox" name="settings[languages][]" value="pt_BR" {% if(in_array('pt_BR', $languages)) %}checked{% endif %}> Português</label>
        </div>

        <div class="checkbox">
            <label><input type="checkbox" name="settings[languages][]" value="en_US" {% if(in_array('en_US', $languages)) %}checked{% endif %}> Inglês</label>
        </div>

        <div class="checkbox">
            <label><input type="checkbox" name="settings[languages][]" value="es_ES" {% if(in_array('es_ES', $languages)) %}checked{% endif %}> Espanhol</label>
        </div>
    </div>
</div>

<?php $countries = $setting->get('countries', ['br']); ?>
<div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label" data-toggle="tooltip-left" title="{{ $i18n->get('app::tooltips.countries') }}">{{ $i18n->get('ui.columns.countries') }}</label>
    <div class="col-sm-10">
        {% foreach ($config->get('app::base.countries') as $code) %}
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="settings[countries][]" value="{{ $code }}" {% if(in_array($code, $countries)) %}checked{% endif %}> {{ $i18n->get("app::base.countries.{$code}") }}
                </label>
            </div>
        {% endforeach %}
    </div>
</div>

<?php $services = $setting->get('enabled_services', []); ?>
<div class="form-group hidden">
    <label class="col-sm-2 col-sm-2 control-label">Serviços Ativos</label>
    <div class="col-sm-10">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="settings[enabled_services][]" value="wolftradeEad" {% if(in_array('wolftradeEad', $services)) %}checked{% endif %}> WolftradeEAD
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="settings[enabled_services][]" value="promark" {% if(in_array('promark', $services)) %}checked{% endif %}> Integração Promark
            </label>
        </div>
    </div>
</div>