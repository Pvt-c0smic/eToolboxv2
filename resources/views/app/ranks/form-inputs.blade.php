@php $editing = isset($rank) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            value="{{ old('code', ($editing ? $rank->code : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="description"
            label="Description"
            value="{{ old('description', ($editing ? $rank->description : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="personnel_type_id"
            label="Personnel Types"
            required
        >
            @php $selected = old('personnel_type_id', ($editing ? $rank->personnel_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Personnel Type</option>
            @foreach($personnelTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
