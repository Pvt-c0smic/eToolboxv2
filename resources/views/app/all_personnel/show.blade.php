@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-personnel.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_personnel.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.last_name')</h5>
                    <span>{{ $personnel->last_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.first_name')</h5>
                    <span>{{ $personnel->first_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.middle_name')</h5>
                    <span>{{ $personnel->middle_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.email')</h5>
                    <span>{{ $personnel->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.phone_number')</h5>
                    <span>{{ $personnel->phone_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.afpsn')</h5>
                    <span>{{ $personnel->afpsn ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.address')</h5>
                    <span>{{ $personnel->address ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.rank_id')</h5>
                    <span>{{ optional($personnel->rank)->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.bos_id')</h5>
                    <span>{{ optional($personnel->bos)->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.office_id')</h5>
                    <span>{{ optional($personnel->office)->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_personnel.inputs.designation')</h5>
                    <span>{{ $personnel->designation ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-personnel.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Personnel::class)
                <a
                    href="{{ route('all-personnel.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
