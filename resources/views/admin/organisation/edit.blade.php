@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.organisation.actions.edit', ['name' => $organisation->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <organisation-form
                :action="'{{ $organisation->resource_url }}'"
                :data="{{ $organisation->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.organisation.actions.edit', ['name' => $organisation->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.organisation.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </organisation-form>

        </div>
    
</div>

@endsection