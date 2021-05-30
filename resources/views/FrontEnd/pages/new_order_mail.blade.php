{{--<!DOCTYPE html>
<html lang="en">
<head>

    <title> Lol </title>
</head>

<body>--}}
{{--    <h1>{{ $data['name'] }}</h1>--}}

    <h3>Hello {{ $data->name ?? '' }}... </h3>
<p>You have a new order</p>
    <hr/>
    <h4>Item name {{ $data->category ?? '' }}</h4>
    <h4>Item amount {{ $data->point ?? '' }}</h4>
<p>Please manage your order from your <a href="{{ route('user_profile') }}"> account </a>.</p>
{{--
</body>

</html>
--}}
