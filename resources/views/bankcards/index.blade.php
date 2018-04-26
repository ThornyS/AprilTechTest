
@extends('layouts.app')
<!-- resources/views/bankcards/index.php -->

@section('title', 'Add Bank Cards')
@section('content')
        <div style="font-size: 48px;" class="title m-b-md">Bank Cards</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <fieldset>
                    <legend>Errors</legend>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </fieldset>
            </div>
        @endif
        {{ Form::open(['files' => true]) }}
        <table>
            <thead>
                <tr><th>Bank</th><th>Card Details</th><th>Expiry date</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ Form::text('bank_name', '', ['size' => 8, 'placeholder' => 'Bank Name'] ) }}</td>
                    <td>{{ Form::text('bank_card', '', ['size' => 20, 'placeholder' => '1234-1234-1234-1234', 'pattern' => '[0-9-]*'] ) }}</td>
                    <td>{{ Form::date('bank_expiry', '', ['placeholder' => 'dd-mm-yyyy'] ) }}</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">{{ Form::file('bank_file') }}</td>
                    <td>{{ Form::submit('Submit') }}</td>
                </tr>
            @if (Session::has('bankcards'))
            @foreach (Session::get('bankcards') as $card)
                @php
                    if (preg_match('/^.*?(\d{4})(.*)$/', $card['bank_card'], $matches)) {
                        $bank_card = $matches[1] . preg_replace('/\d/', 'x', $matches[2]);
                    }
                @endphp
                <tr>
                    <td>{{ $card['bank_name'] }}</td>
                    <td>{{ $bank_card }}</td>
                    <td>{{ date("M Y", strtotime($card['bank_expiry'])) }}</td>
                </tr>
            @endforeach
            @endif
            {{ Form::close() }}
            </tbody>
        </table>
@endsection
