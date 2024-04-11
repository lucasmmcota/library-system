@php
    $defaultValue = empty($oldValue) ? old($name) : old($name, $oldValue);
    $arrayKeys = array_keys($arrayValue);
@endphp

@if (!empty($label)) @include('components.label', ['label' => $label]) @endif
<div class="input-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
    <select id="{{ $id }}" name="{{ $name }}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}">
        <option style="background-color: #344675;" value="">Selecione</option>
        @foreach ($arrayKeys as $key)
        <option
            style="background-color: #344675;"
            value="{{ $key }}"
            {{ $key == $defaultValue ? 'selected' : '' }}
        >
            {{ $arrayValue[$key] }}
        </option>
        @endforeach
    </select>
    @include('components.alerts.feedback', ['field' => $name])
</div>
