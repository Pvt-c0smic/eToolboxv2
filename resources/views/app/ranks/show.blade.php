@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('ranks.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.ranks.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.ranks.inputs.code')</h5>
                    <span>{{ $rank->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.ranks.inputs.description')</h5>
                    <span>{{ $rank->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.ranks.inputs.personnel_type_id')</h5>
                    <span
                        >{{ optional($rank->personnelTypes)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('ranks.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Rank::class)
                <a href="{{ route('ranks.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
