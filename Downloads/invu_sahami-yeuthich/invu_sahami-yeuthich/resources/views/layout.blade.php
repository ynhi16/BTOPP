<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/trangchu.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/khachhang.css')}}">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
</head>

<body>

    <div class="wrapper">
        @include('header')

        @yield('trangchu')
    </div>

    @include('footer')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#key').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
                var query = $(this).val(); //lấy gía trị ng dùng gõ
                if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
                {
                    var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                    $.ajax({
                        url: "{{url('/auto-ajax')}}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                        method: "POST", // phương thức gửi dữ liệu.
                        data: {
                            query: query,
                            _token: _token
                        },
                        success: function(data) { //dữ liệu nhận về
                            $('#search_ajax').fadeIn();
                            $('#search_ajax').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $('#search_ajax').html('')
                }
            });
        });
        $(document).on('click', '.search', function() {
            $('#key').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>

    <script>

        var usd = document.getElementById("vnd_to_usd").value;

        paypal.Button.render({

        // Configure environment

        env: 'sandbox',

        client: {

        sandbox: 'demo_sandbox_client_id',

        production: 'demo_production_client_id'

        },

        // Customize button (optional)

        locale: 'en_US',

        style: {

        size: 'small',

        color: 'gold',

        shape: 'pill',

        },
        // Enable Pay Now checkout flow (optional)

        commit: true,



        // Set up a payment

        payment: function(data, actions) {

            return actions.payment.create({

                transactions: [{

                amount: {

                    total: `${usd}`,

                    currency: 'USD'

                }

                }]

            });

        },

        // Execute the payment

        onAuthorize: function(data, actions) {

            return actions.payment.execute().then(function() {

                // Show a confirmation message to the buyer

                window.alert('Bạn đã thanh toán thành công');

            });

        }

        }, '#paypal-button');
    </script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
</body>

</html>
