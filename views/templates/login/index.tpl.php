<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Aliadus Agência - www.aliadus.com.br">

    <title>Aliadus Agência - System Janitor</title>

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
    <div id="login-page">
        <div class="container">
            <form action="login/auth/" method="POST" class="form-login">
                <h2 class="form-login-heading">Fazer Login</h2>

                <div class="login-wrap">
                    {% if($session->hasFlash('error')) %}
                        <div class="alert alert-danger"><b>Erro!</b> {{ $session->getFlash('error') }}</div>
                    {% endif %}

                    <input type="password" name="password" class="form-control" placeholder="Senha" required />
                    <br/>

                    <input type="hidden" name="{{ $csrf_matches }}" value="{{ $csrf_compare }}" />

                    <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> Login</button>
                </div>
            </form>
        </div>
    </div>

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
</body>
</html>