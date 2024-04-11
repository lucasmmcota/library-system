@php
    if ($reference_book) {
        $checkedS = 'checked';
        $checkedN = '';
    } else {
        $checkedS = '';
        $checkedN = 'checked';
    }
@endphp

<div class="row col-sm-12">
    <div class="col-sm-6">
        <label style="font-size: 18px;"> {{ $message }}</label>
    </div>
    <div class="col-sm-3">
        <label style="font-size: 18px;">
            <input type="radio" name="{{ $name }}" value="1" {{ $checkedS }}>&nbsp; Sim
        </label>
    </div>
    <div class="col-sm-3">
        <label style="font-size: 18px;">
            <input type="radio" name="{{ $name }}" value="0" {{ $checkedN }}>&nbsp; Não
        </label>
    </div>
</div>
