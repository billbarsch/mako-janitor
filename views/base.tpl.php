<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>System Janitor</title>

    <base href="{{ $__base__ }}">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ $urlBuilder->to('/app/packages/mako-janitor/assets/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <section id="container" >
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <a href="" class="logo"><b>SYSTEM JANITOR</b></a>

            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="login/logout/"><i class="fa fa-fw fa-power-off"></i> Desconectar</a></li>
                </ul>
            </div>
        </header>

        <aside>
            <div id="sidebar"  class="nav-collapse">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li class="mt"><a href=""><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="logs"><i class="fa fa-fw fa-bug"></i> Logs do Sistema</a></li>
                    <li><a href="migrations"><i class="fa fa-fw fa-database"></i> Migrations</a></li>
                    <li><a href="settings"><i class="fa fa-fw fa-cogs"></i> Configurações</a></li>
                </ul>
            </div>
        </aside>

        <section id="main-content">
            <section class="wrapper site-min-height">
                <h1>{{ block:title }}{{ endblock }}</h1>
                <div class="row mt">
                    <div class="col-lg-12">
                        {% if($session->hasFlash('success')) %}
                            <div class="alert alert-success"><b>Sucesso!</b> {{ $session->getFlash('success') }}.</div>
                        {% endif %}

                        {% if($session->hasFlash('error')) %}
                            <div class="alert alert-danger"><b>Erro!</b> {{ $session->getFlash('error') }}.</div>
                        {% endif %}

                        {{ block:content }}{{ endblock }}
                    </div>
                </div>
            </section>
        </section>
    </section>

    <div class="modal primary fade" id="ajaxModal"><div class="modal-dialog modal-lg"><div class="modal-content"></div></div></div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <script type="text/javascript">
        // Reset ajax modal on close
        $(document).on('hidden.bs.modal', '#ajaxModal', function(){
            $(this).removeData('bs.modal');
        });

        // Dialog executar URL
        $(document).on('click', 'a.dialog-confirm-url', function(e) {
            e.preventDefault();

            var href = $(this).attr('href');

            var htmlTitle = $(this).attr('title');

            var tooltipTitle = $(this).attr('data-original-title');

            var dialogTitle = (htmlTitle == '') ? tooltipTitle : htmlTitle;

            var dialogTitle = $(this).html();

            bootbox.dialog({
                message: "Deseja realmente executar esta ação ?",
                title: dialogTitle,
                buttons: {
                    danger: {
                        label: '<i class="fa fa-times"></i> Cancelar',
                        className: "btn-danger",
                        callback: function() { }
                    },
                    main: {
                        label: '<i class="fa fa-check"></i> OK',
                        className: "btn-primary",
                        callback: function() {
                            $(location).attr('href', href);
                        }
                    }
                }
            });
        });

        // sidebar toggle
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);

        $('.fa-bars').click(function () {
            if ($('#sidebar > ul').is(":visible") === true) {
                $('#main-content').css({
                    'margin-left': '0px'
                });
                $('#sidebar').css({
                    'margin-left': '-210px'
                });
                $('#sidebar > ul').hide();
                $("#container").addClass("sidebar-closed");
            } else {
                $('#main-content').css({
                    'margin-left': '210px'
                });
                $('#sidebar > ul').show();
                $('#sidebar').css({
                    'margin-left': '0'
                });
                $("#container").removeClass("sidebar-closed");
            }
        });
    </script>

    {{ block:scripts }}{{ endblock }}
</body>
</html>