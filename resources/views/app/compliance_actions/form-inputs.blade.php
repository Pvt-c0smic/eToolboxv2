@php $editing = isset($complianceAction) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="compliance_id" label="Compliance" required>
            @php $selected = old('compliance_id', ($editing ? $complianceAction->compliance_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Compliance</option>
            @foreach($compliances as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="action_taken"
            label="Action Taken"
            maxlength="255"
            required
            >{{ old('action_taken', ($editing ? $complianceAction->action_taken
            : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="commander_comment"
            label="Commander Comment"
            maxlength="255"
            required
            >{{ old('commander_comment', ($editing ?
            $complianceAction->commander_comment : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="percentage"
            label="Percentage"
            value="{{ old('percentage', ($editing ? $complianceAction->percentage : '')) }}"
            max="255"
            step="0.01"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="updated_date"
            label="Updated Date"
            value="{{ old('updated_date', ($editing ? optional($complianceAction->updated_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
