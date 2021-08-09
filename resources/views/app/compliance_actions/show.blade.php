@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('compliance-actions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.compliance_actions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.compliance_actions.inputs.compliance_id')
                    </h5>
                    <span
                        >{{ optional($complianceAction->compliance)->start_date
                        ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.compliance_actions.inputs.action_taken')
                    </h5>
                    <span>{{ $complianceAction->action_taken ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.compliance_actions.inputs.commander_comment')
                    </h5>
                    <span
                        >{{ $complianceAction->commander_comment ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.compliance_actions.inputs.percentage')</h5>
                    <span>{{ $complianceAction->percentage ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.compliance_actions.inputs.updated_date')
                    </h5>
                    <span>{{ $complianceAction->updated_date ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('compliance-actions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ComplianceAction::class)
                <a
                    href="{{ route('compliance-actions.create') }}"
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
