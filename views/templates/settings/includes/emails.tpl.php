<div class="form-group">
    <div class="col-sm-6">
        <label>{{ $i18n->get('ui.columns.smtp-host') }}</label>
        <input type="text" name="settings[carteiro][host]" value="{{ $setting->get('carteiro.host') }}" class="form-control">
    </div>

    <div class="col-sm-3">
        <label>{{ $i18n->get('ui.columns.smtp-port') }}</label>
        <input type="text" name="settings[carteiro][port]" value="{{ $setting->get('carteiro.port') }}" class="form-control">
    </div>

    <div class="col-sm-3">
        <label>{{ $i18n->get('ui.columns.smtp-secure') }}Segurança</label>
        <select class="form-control" name="settings[carteiro][secure]">
            <option value=""></option>
            <option value="ssl" {% if($setting->get('carteiro.secure') == 'ssl') %}selected{% endif %}>SSL</option>
            <option value="starttls" {% if($setting->get('carteiro.secure') == 'starttls') %}selected{% endif %}>TLS</option>
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-6">
        <label>{{ $i18n->get('ui.columns.smtp-user') }}</label>
        <input type="text" name="settings[carteiro][user]" value="{{ $setting->get('carteiro.user') }}" class="form-control">
    </div>

    <div class="col-sm-6">
        <label>{{ $i18n->get('ui.columns.smtp-pass') }}</label>
        <input type="text" name="settings[carteiro][pass]" value="{{ $setting->get('carteiro.pass') }}" class="form-control">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-4">
        <label>{{ $i18n->get('ui.columns.smtp-sender') }}</label>
        <input type="text" name="settings[carteiro][sender]" value="{{ $setting->get('carteiro.sender') }}" class="form-control">
    </div>

    <div class="col-sm-4">
        <label>{{ $i18n->get('ui.columns.smtp-from') }}</label>
        <input type="email" name="settings[carteiro][from]" value="{{ $setting->get('carteiro.from') }}" class="form-control">
    </div>

    <div class="col-sm-4">
        <label>{{ $i18n->get('ui.columns.smtp-reply') }}</label>
        <input type="email" name="settings[carteiro][reply]" value="{{ $setting->get('carteiro.reply') }}" class="form-control">
    </div>
</div>