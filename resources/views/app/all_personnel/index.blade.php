@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.all_personnel.index_title')
                </h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="icon ion-md-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\Personnel::class)
                        <a
                            href="{{ route('all-personnel.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.last_name')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.first_name')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.middle_name')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.email')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.phone_number')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.afpsn')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.address')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.rank_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.bos_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.office_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.all_personnel.inputs.designation')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allPersonnel as $personnel)
                        <tr>
                            <td>{{ $personnel->last_name ?? '-' }}</td>
                            <td>{{ $personnel->first_name ?? '-' }}</td>
                            <td>{{ $personnel->middle_name ?? '-' }}</td>
                            <td>{{ $personnel->email ?? '-' }}</td>
                            <td>{{ $personnel->phone_number ?? '-' }}</td>
                            <td>{{ $personnel->afpsn ?? '-' }}</td>
                            <td>{{ $personnel->address ?? '-' }}</td>
                            <td>
                                {{ optional($personnel->rank)->code ?? '-' }}
                            </td>
                            <td>
                                {{ optional($personnel->bos)->code ?? '-' }}
                            </td>
                            <td>
                                {{ optional($personnel->office)->code ?? '-' }}
                            </td>
                            <td>{{ $personnel->designation ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $personnel)
                                    <a
                                        href="{{ route('all-personnel.edit', $personnel) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $personnel)
                                    <a
                                        href="{{ route('all-personnel.show', $personnel) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $personnel)
                                    <form
                                        action="{{ route('all-personnel.destroy', $personnel) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12">
                                {!! $allPersonnel->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
