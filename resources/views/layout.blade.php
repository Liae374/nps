<!DOCTYPE html>
<html>
    <head>
        <title>NPS</title>
        <meta charset='utf8'>
        <link href='/ressources/css/style.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x' crossorigin='anonymous'>
    <style>
        .body {
            width: 768px;
            height: 1024px;
            margin-right: auto;
            margin-left: auto;
        }

        .rating {
            float:left;
        }

        /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
        follow these rules. Every browser that supports :checked also supports :not(), so
        it doesn’t make the test unnecessarily selective */
        .rating:not(:checked) > input {
            position:absolute;
            clip:rect(0,0,0,0);
        }

        .rating:not(:checked) > label {
            float:right; 
            width:1em;
            /* padding:0 .1em; */
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:300%;
            /* line-height:1.2; */
            color:#ddd;
        }

        .rating:not(:checked) > label:before {
            content: '★ ';
        }

        .rating > input:checked ~ label {
            color: dodgerblue;
            
        }

        .rating:not(:checked) > label:hover,
        .rating:not(:checked) > label:hover ~ label {
            color: dodgerblue;
            
        }

        .rating > input:checked + label:hover,
        .rating > input:checked + label:hover ~ label,
        .rating > input:checked ~ label:hover,
        .rating > input:checked ~ label:hover ~ label,
        .rating > label:hover ~ input:checked ~ label {
            color: dodgerblue;
            
        }

        .rating > label:active {
            position:relative;
            top:2px;
            left:2px;
        }

        .infoLeft {
            margin-top: 20px ;
            margin-left: 144px;
            margin-right: 60px;
            margin-bottom: 0;
            width: 10em;
            text-align: left;
            float:left;
        }

        .infoRight {
            margin-top: 20px;
            margin-left: 60px;
            margin-right: 144px;
            margin-bottom: 0;
            width: 10em;
            text-align: right;
            float:right;
        }
    </style>
    </head>
    <body>
            @yield('content')
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4' crossorigin='anonymous'></script>
    </body>
</html>