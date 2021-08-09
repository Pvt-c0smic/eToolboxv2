@php $editing = isset($bos) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            value="{{ old('code', ($editing ? $bos->code : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="description"
            label="Description"
            value="{{ old('description', ($editing ? $bos->description : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
