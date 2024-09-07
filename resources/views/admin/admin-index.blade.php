@extends('layouts.admin')

@section('content')

        <h2 class="mb-4 text-center">مدیریت کاربران</h2>
        @component('components.errors',["title"=>"خطا"])
        @endcomponent

        @component('components.modal-button',["id"=>"#addUserModal","value" => "کاربر جدید"])
        @endcomponent

        @component('components.table')
            @slot('thead')
                    <th>عملیات</th>
                    <th>ایمیل</th>
                    <th>نام</th>
            @endslot
            @slot('tbody')
                @foreach ($users as $value)
                    <tr>
                        <td>
                            @component('components.modal-button',["value" => "ویرایش" ,"class"=>"btn btn-warning btn-sm"])
                                @slot('id')
                                    #editUserModal{{ $value->id }}
                                @endslot
                            @endcomponent

                                @component('components.modal-button',["value" => "حذف" ,"class"=>"btn btn-danger btn-sm"])
                                    @slot('id')
                                        #deleteUserModal{{ $value->id }}
                                    @endslot
                                @endcomponent
                        </td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->name }}</td>
                    </tr>

                    @component('components.modal',["title"=>"ویرایش کاربر" ,"action" => "admin.update" ,"name" => "ویرایش"])
                        @slot('actionValue')
                            {{$value->id}}
                        @endslot

                        @slot('id')
                            editUserModal{{ $value->id }}
                        @endslot

                        @method('PATCH')
                        @component('components.form-grupe' , ["id"=>"name","name"=>"name","title"=>"نام"])
                            @slot('value')
                                {{ $value->name }}
                            @endslot
                        @endcomponent

                        @component('components.form-grupe' , ["id"=>"email","name"=>"email","title"=>"ایمیل"])
                            @slot('value')
                                {{ $value->email }}
                            @endslot
                        @endcomponent

                        @component('components.form-grupe' , ["id"=>"password","name"=>"password","title"=>"پسوورد"])
                        @endcomponent
                    @endcomponent

                    @component('components.modal',["title"=>"حذف کاربر" ,"action" => "admin.destroy" ,"name" => "حذف"])
                        @slot('actionValue')
                            {{$value->id}}
                        @endslot

                        @slot('id')
                            deleteUserModal{{ $value->id }}
                        @endslot

                        @method('DELETE')
                        @component('components.form-grupe' , ["id"=>"name","name"=>"name","title"=>"نام","attributes" => "readonly"])
                            @slot('value')
                                {{ $value->name }}
                            @endslot
                        @endcomponent

                        @component('components.form-grupe' , ["id"=>"email","name"=>"email","title"=>"ایمیل" ,"attributes" => "readonly"])
                            @slot('value')
                                {{ $value->email }}
                            @endslot
                        @endcomponent
                    @endcomponent
                @endforeach
            @endslot
        @endcomponent

    @component('components.modal',["id"=>"addUserModal" ,"title"=>"کاربر جدید" ,"action" => "admin.store" ,"name" => "افزودن"])
        @component('components.form-grupe' , ["id"=>"name","name"=>"name","title"=>"نام"])
        @endcomponent

        @component('components.form-grupe' , ["id"=>"email","name"=>"email","title"=>"ایمیل"])
        @endcomponent

        @component('components.form-grupe' , ["id"=>"password","name"=>"password","title"=>"پسوورد"])
        @endcomponent
    @endcomponent

@endsection

@section("script")
    @if($errors->all())
        @component("components.show-modal")
        @endcomponent
    @endif
@endsection
