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
        <h3>{{ __('Stock Opname') }}</h3>
        <p>{{ $transaction->transaction_at_formatted ??  '['. __('Stock Opname Date') .']' }}</p>
        <h6>{{ $transaction->category->name ?? '['. __('Category Name') .']' }} - {{ __($transaction->category->operation) ?? '['. __('operation') .']' }}</h6>
        <p>{{ $transaction->description ?? '['. __('Description') .']' }}</p>
    </div>
</header>

<footer>
    <p>{{ __('Created by ') }} {{ $transaction->creator->name ?? '['. __('createdBy') .']'}} {{ __('at') }} {{ $transaction->created_at ?? '['. __('createdAt') .']'}}</p>
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
            <th style="width: 100px;">{{ __('Quantity') }}</th>
            <th style="width: 60px;">{{ __('Unit') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($transaction->items))
            @foreach($transaction->items as $item)
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
