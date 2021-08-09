@php $editing = isset($compliance) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="office_id" label="Office" required>
            @php $selected = old('office_id', ($editing ? $compliance->office_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Office</option>
            @foreach($offices as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="start_date"
            label="Start Date"
            value="{{ old('start_date', ($editing ? optional($compliance->start_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="end_date"
            label="End Date"
            value="{{ old('end_date', ($editing ? optional($compliance->end_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="project_name"
            label="Project Name"
            value="{{ old('project_name', ($editing ? $compliance->project_name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status_id" label="Status" required>
            @php $selected = old('status_id', ($editing ? $compliance->status_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Status</option>
            @foreach($statuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
