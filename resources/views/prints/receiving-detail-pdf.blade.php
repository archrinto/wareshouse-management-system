<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="{{ public_path('css/print-pdf.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <div class="text-center">
            <h5>{{ $companyName ?? '['. __('Company Name') .']' }}</h5>
            <h3>{{ __('Goods Receiving') }}</h3>
            <p>{{ $receivingDate ??  '['. __('Receiving Date') .']' }}</p>
            <h6>{{ $shipperName ?? '['. __('Shipper Name') .']' }}</h6>
        </div>
    </header>

    <footer>
        <p>{{ __('Created by ') }} {{ $createdBy ?? '['. __('createdBy') .']'}} {{ __('at') }} {{ $createdAt ?? '['. __('createdAt') .']'}}</p>
        <p>{{ __('Printed by ') }} {{ $printedBy ?? '['. __('printedBy') .']'}} {{ __('at') }} {{ $printedAt ?? '['. __('printedAt') .']'}}</p>
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
                <th style="width: 100px;">{{ __('Quantity') }}</th>
                <th style="width: 60px;">{{ __('Unit') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($items))
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->goods->code }}</td>
                        <td>{{ $item->goods->name }}</td>
                        <td>{{ $item->quantity ?? '-' }}</td>
                        <td>{{ $item->goods->unit->name ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                @foreach(range(1, 30) as $item)
                    <tr>
                        <td>[{{ __('Product Code') }}]</td>
                        <td>[{{ __('Product Name') }}]</td>
                        <td>[{{ __('Quantity') }}]</td>
                        <td>[{{ __('Unit') }}]</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </main>

</body>
</html>
