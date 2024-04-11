@if (!empty($label)) @include('components.label', ['label' => $label]) @endif
<div class="input-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    @if (!empty($icon))
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
    @endif
    <input
        type="{{ empty($type) ? 'text' : $type }}"
        name="{{ $name }}"
        id="{{ empty($id) ? $name : $id }}"
        class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
        @if (!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
        @if (empty($type) || (!empty($type) && $type != 'password'))
            value="{{ empty($oldValue) ? old($name) : old($name, $oldValue) }}"
        @endif
        @if (!empty($maxLength)) maxlength="{{ $maxLength }}" @endif
        @if (!empty($readOnly)) style="background-color: transparent; color: white" readonly="true" @endif
    >
    @include('components.alerts.feedback', ['field' => $name])
</div>
