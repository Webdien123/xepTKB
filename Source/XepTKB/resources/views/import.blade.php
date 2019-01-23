        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <!-- Loading modal css -->
        <link rel="stylesheet" href="{{ asset('css/jquery.loadingModal.min.css') }}">

        <!-- jQuery -->
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

        <!-- Bootstrap JavaScript -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!-- Loading modal js -->
        <script src="{{ asset('js/jquery.loadingModal.min.js') }}"></script>

        <!-- Font awsome -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">        

        <!-- Icon website -->
        <link rel="icon" href="http://c2.cdn.truelife.vn/webtube/201405/2420219/logo_tkb.png?f=mVb|9h5fLD2FKo/li54snA==">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Header css -->
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">

        <!-- Footer css -->
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

        <!-- Hiển thị modal loading -->
        <script>
            function showModal() {
                $('body').loadingModal({text: 'Vui lòng chờ trong giây lát...'});

                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 2000;

                delay(0)
                    .then(function() { 
                        $('body').loadingModal('animation', 'wave').loadingModal('backgroundColor', 'blue'); 
                        return delay(time);
                    })
            }

        </script>


        <!-- Chặn xem mã nguồn trang -->
        <!-- <script type="text/javascript">
            $(document).ready(function() {
                $(document).on("contextmenu", function(e) {
                    return false;
                });
                $(document).keydown(function(event) {
                    if (
                        event.keyCode == 123 || 
                        ((event.ctrlKey || event.metaKey) && event.keyCode == 85) || 
                        ((event.ctrlKey || event.metaKey) && event.shiftKey && event.keyCode == 73 || event.keyCode == 116) || 
                        ((event.ctrlKey || event.metaKey) && event.which == 83)) {
                        return false;
                    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                        return false; //Prevent from ctrl+shift+i
                    }
                });
            });
        </script> -->