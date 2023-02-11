<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="{{ public_path('css/print-pdf.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <div class="text-left">
        <h5>{{ $companyName ?? '['. __('Company Name') .']' }}</h5>
        <h3>{{ __('Goods  List') }}</h3>
        <p>{{ $printedAt ??  '['. __('Print At') .']' }}</p>
    </div>
</header>

<footer>
    <p>{{ __('Printed by ') }} {{ $printedBy->name ?? '['. __('printedBy') .']'}} {{ __('at') }} {{ $printedAt ?? '['. __('printedAt') .']'}}</p>
    <div class="text-center">
        <div class="page-number"></div>
    </div>
</footer>

<main>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 150px;">{{ __('Product Code') }}</th>
            <th>{{ __('Product Name') }}</th>
            <th style="width: 100px;" class="text-right">{{ __('Quantity') }}</th>
            <th style="width: 60px;">{{ __('Unit') }}</th>
            <th class="text-right">{{ __('Value') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
            $totalValue = 0;
        @endphp
        @if(isset($goods))
            @foreach($goods as $item)
                @php
                    $value = $item->stock * $item->price;
                    $totalValue += $value;
                @endphp
                <tr>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-right">{{ number_format($item->stock ?? 0 ) ?? '[stock]' }}</td>
                    <td>{{ $item['unit.symbol'] ?? '-' }}</td>
                    <td class="text-right">{{ number_format($value) ?? '[price]' }}</td>
                </tr>
            @endforeach
        @else
            @foreach(range(1, 30) as $item)
                <tr>
                    <td>[{{ __('Product Code') }}]</td>
                    <td>[{{ __('Product Name') }}]</td>
                    <td>[{{ __('Quantity') }}]</td>
                    <td>[{{ __('Unit') }}]</td>
                    <td>[{{ __('Value') }}]</td>
                </tr>
            @endforeach
        @endif
        <tr class="bg-gray-100">
            <td colspan="4">{{ __('Total') }}</td>
            <td class="text-right">{{ number_format($totalValue) }}</td>
        </tr>
        </tbody>
    </table>
</main>

</body>
</html>
