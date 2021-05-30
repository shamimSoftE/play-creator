<h3>Hello {{ $dataTwo->name ?? '' }}... </h3>
<p>You have a new order</p>
<hr/>
<h4>Item name {{ $dataTwo->category ?? '' }}</h4>
<h4>Item amount {{ $dataTwo->point ?? '' }}</h4>
<p>Please manage your order from your <a href="{{ route('user_profile') }}"> account </a>.</p>
