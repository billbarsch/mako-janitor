<?php $secret = $config->get('app::base.cron_secret'); ?>
<?php $prazo_expiracao = $config->get('makocart::settings.pedidos.prazo_expiracao'); ?>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.assinaturas-debitar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/assinaturas/debitar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.assinaturas-debitar-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.pedidos-cancelar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/pedidos/cancelar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.pedidos-cancelar-cron', [$prazo_expiracao]) }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.reservas-deletar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/reservas/cancelar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.reservas-deletar-cron', [$prazo_expiracao]) }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.recargas-deletar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/recargas/deletar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.recargas-deletar-cron', [$prazo_expiracao]) }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.assinaturas-faturas-renovar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/assinaturas/renovar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.assinaturas-faturas-renovar-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.assinaturas-desativar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/assinaturas/desativar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.assinaturas-desativar-cron', [$configuracoes['dias_carencia']]) }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.notificar-vencimento') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/assinaturas/notificar-vencimento/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.notificar-vencimento-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.assinaturas-faturas-pagar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/assinaturas/pagar-automatico/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.assinaturas-faturas-pagar-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.planos-upgrade-desativar') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/upgrades/desativar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.planos-upgrade-desativar-cron', [$configuracoes['dias_carencia']]) }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.upgrade-notificar-vencimento') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/upgrades/notificar-vencimento/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.upgrade-notificar-vencimento-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.pagar-automatico') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/upgrades/pagar-automatico/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.pagar-automatico-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.premiar-fixo') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/premiacoes/premiar-fixo/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.premiar-fixo-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.premiar-binario') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/premiacoes/premiar-binario/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.premiar-binario-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.premiar-matriz-fechada') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/premiacoes/matriz-fechada/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.premiar-matriz-fechada-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.premiar-bonus-diario') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/premiacoes/premiar-bonus-diario/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.premiar-bonus-diario-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.premiar-bonus-geracao') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/premiacoes/premiar-bonus-geracao/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.premiar-bonus-geracao-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.premiar-bonus-superacao') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/premiacoes/premiar-bonus-superacao/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.premiar-bonus-superacao-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.premiar-bonus-pontoaponto') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/premiacoes/premiar-bonus-pontoaponto/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.premiar-bonus-pontoaponto-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.processar-compras-coletivas') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/compras-coletivas/processar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.processar-compras-coletivas-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.processar-graduacoes') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/graduacoes/processar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.processar-graduacoes-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.excluir-afiliados-expirados') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/afiliados/excluir-expirados/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.excluir-afiliados-expirados-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>{{ $i18n->get('ui.strings.liberar-comissoes') }}</strong></label>
    <input type="text" value="{{ $urlBuilder->to("/cronjobs/comissoes/liberar/{$secret}") }}" class="form-control" readonly>
    <span class="help-block">{{ $i18n->get('ui.strings.liberar-comissoes-cron') }}</span>
</div>

<div class="form-group">
    <label><strong>Linha de Comando</strong></label>
    <input type="text" value="php {{ MAKO_APPLICATION_PATH }}/reactor makoscheduler::cronjobs.run 1>> /dev/null 2>&1" class="form-control" readonly>
    <span class="help-block">Cronjobs para execução em linha de comando. Configure o comando para executar a cada minuto</span>
</div>