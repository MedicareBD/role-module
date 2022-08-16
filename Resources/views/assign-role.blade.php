@extends('core::layouts.admin.app')

@section('title', __('Assign Role'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <h3>{{ __("Assign Role To User") }}</h3>
                    </div>

                    <form action="{{ route('admin.assign-role.store') }}" method="post" class="row instant_reload_form">
                        @csrf

                        <div class="col-12 form-group">
                            <label for="user" class="required">{{ __("User") }}</label>
                            <select name="user" id="user" data-placeholder="{{ __('Select User') }}" required>

                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="role" class="required">{{ __("Role") }}</label>
                            <select name="roles[]" id="role" data-control="select2" data-placeholder="{{ __('Select Role') }}" multiple required>
                                <option></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ __("Submit") }}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">
                                {{ __("Discard") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('pageScripts')
    <script>
        $(document).ready(function () {
            $("#user").select2({
                ajax: {
                    type: 'post',
                    url: "{{ route('admin.assign-role.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * data.per_page) < data.total
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2,
                templateResult: formatState,
                templateSelection: formatTemplateSelection
            });


            function formatState (state) {
                if (state.loading) {
                    return state.text;
                }

                return $(
                    '<div class="d-flex align-items-center">'+
                    '<figure class="avatar mr-2 avatar-sm mr-3"><img src="'+state.avatar+'"/></figure>'+
                    '<span> ' + state.text + '</span>'+
                    '</div>'
                    // '<span><img src="'+state.image+'" class="img-flag" /> ' + state.text + '</span>'
                );
            }

            function formatTemplateSelection(state) {
                if (!state.id){
                    return state.text;
                }

                return $(
                    '<div class="d-flex align-items-center">'+
                    '<figure class="avatar mr-2 avatar-sm mr-3"><img src="'+state.avatar+'"/></figure>'+
                    '<span> ' + state.text + '</span>'+
                    '</div>'
                    // '<span><img src="'+state.image+'" class="img-flag" /> ' + state.text + '</span>'
                );
            }
        })
    </script>
@endpush
