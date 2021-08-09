@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('compliances.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.compliances.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.compliances.inputs.office_id')</h5>
                    <span
                        >{{ optional($compliance->office)->code ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.compliances.inputs.start_date')</h5>
                    <span>{{ $compliance->start_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.compliances.inputs.end_date')</h5>
                    <span>{{ $compliance->end_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.compliances.inputs.project_name')</h5>
                    <span>{{ $compliance->project_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.compliances.inputs.status_id')</h5>
                    <span
                        >{{ optional($compliance->status)->name ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('compliances.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Compliance::class)
                <a
                    href="{{ route('compliances.create') }}"
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
