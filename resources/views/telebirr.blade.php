<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Telebirr Helper</title>
    <style>
        /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
        }

        /* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
        body.loading .modal {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
   modal element will be visible */
        body.loading .modal {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container align-content-center shadow-sm bg-white rounded">
        <h5>information from telebirr</h5>
        <div class="container">
            <div class="row ">
                <div class="col mb-1">
                    <input type="text" class="form-control text-center" id="appid" placeholder="your app id">
                </div>
                <div class="col">
                    <input type="text" class="form-control text-center" id="appkey" placeholder="app key">
                </div>
            </div>
            <div class="row ">
                <div class="col mb-1">
                    <input type="text" class="form-control text-center" id="shortcode" placeholder="short code">
                </div>
                <div class="col mb-1">
                    <input type="text" class="form-control text-center" id="api" placeholder="api">
                </div>
            </div>
            <div class="row ">
                <div class="col mb-1">
                    <input type="text" class="form-control text-center" id="notifyurl" placeholder="Notify Url">
                </div>
                <div class="col mb-1">
                    <input type="text" class="form-control text-center" id="returnurl" placeholder="Return Url">
                </div>
            </div>
            <div class="row ">
                <div class="col mb-1">
                    <input type="text" class="form-control text-center" id="timeout" value="30" placeholder="Set Time Out">
                </div>
                <div class="col mb-1">
                    <input type="text" class="form-control text-center" id="reciver" value="Reciver Name" placeholder="Reciver Name">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col ">
                    <input type="text" class=" mb-3 form-control text-center" id="publickey" placeholder="public key">
                </div>
            </div>
        </div>
    </div>
    <div class="container align-content-center shadow-sm bg-white rounded">
        <h5>Data given by you</h5>
        <div class="container">
            <div class="row form-group">
                <div class="col mb-1 ">
                    <label for="godsname" class="col-form-label">Item Name:</label>
                    <input type="text" class="subject form-control text-center" value="book buy" id="subject" placeholder="Item Name">
                </div>
                <div class="col mb-1">
                    <label for="amount" class=" col-form-label">Amount to pay:</label>
                    <input type="text" class="amount form-control text-center" id="amount" value="5" placeholder="Amount to pay">
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-around pt-1">
        <button type="button" class="submit btn btn-success" onclick="getJson()">Get Json for postman</button>
        <button type="button" class="getdata btn btn-primary" onclick="requestTele()">Request to telebirr</button>
        <button type="button" class="cleardata btn btn-danger" onclick="clearData()">Clear Data</button>
    </div>
    <div class="container  shadow-sm p-3 mb-1 bg-white rounded ">
        <h5 class="jsonarea">json for postman</h5>
        <textarea class="jsondata form-control" id="jsondata" rows="10"></textarea>

        <button type="button" class="pay btn btn-success d-none">GoToPayment</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>
        $body = $("body");

        $(document).on({
            ajaxStart: function() {
                $body.addClass("loading");
            },
            ajaxStop: function() {
                $body.removeClass("loading");
            }
        });

        function getJson() {

            var timeout = $("#timeout").val();
            var receiveName = $("#reciver").val();
            var subject = $("#subject").val();
            var amount = $("#amount").val();

            $.ajax({
                url: '/getjson',
                type: 'post',
                data: {
                    subject,
                    receiveName,
                    amount,
                    timeout,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(data) {
                    console.info(data);
                    $("#jsondata").val(JSON.stringify(data, null, 2));
                }
            });
        }



        function requestTele() {
            var timeout = $("#timeout").val();
            var receiveName = $("#reciver").val();
            var subject = $("#subject").val();
            var amount = $("#amount").val();
           
                $.ajax({
                    url: '/requestTele',
                    type: 'post',
                    data: {
                        subject,
                        receiveName,
                        amount,
                        timeout,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(data) {
                        var jsonPretty = JSON.stringify(data, null, 2);
                        doStuff(data.url);
                        $("#jsondata").val(jsonPretty);
                    }
                });

            
        }

        function doStuff(url) {
            console.info("Doing some stuff");
            $("h5").last().html("Data from Telebirr");
            $("button").last().removeClass("d-none")
            $("button").last().attr("onclick", "window.open('" + url + "','_blank')")
        }

        function clearData() {
           $("#timeout").val("");
           $("#reciver").val("");
             $("#subject").val("");
            $("#amount").val("");

        }
    </script>
    <div class="modal"><!-- Place at bottom of page --></div>

</body>

</html>