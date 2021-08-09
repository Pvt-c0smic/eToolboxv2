@php $editing = isset($personnel) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="last_name"
            label="Last Name"
            value="{{ old('last_name', ($editing ? $personnel->last_name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="first_name"
            label="First Name"
            value="{{ old('first_name', ($editing ? $personnel->first_name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="middle_name"
            label="Middle Name"
            value="{{ old('middle_name', ($editing ? $personnel->middle_name : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $personnel->email : '')) }}"
            maxlength="255"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone_number"
            label="Phone Number"
            value="{{ old('phone_number', ($editing ? $personnel->phone_number : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="afpsn"
            label="Afpsn"
            value="{{ old('afpsn', ($editing ? $personnel->afpsn : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="address"
            label="Address"
            maxlength="255"
            required
            >{{ old('address', ($editing ? $personnel->address : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="rank_id" label="Rank" required>
            @php $selected = old('rank_id', ($editing ? $personnel->rank_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Rank</option>
            @foreach($ranks as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="bos_id" label="Bos" required>
            @php $selected = old('bos_id', ($editing ? $personnel->bos_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Bos</option>
            @foreach($allBos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="office_id" label="Office" required>
            @php $selected = old('office_id', ($editing ? $personnel->office_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Office</option>
            @foreach($offices as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="designation"
            label="Designation"
            value="{{ old('designation', ($editing ? $personnel->designation : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
