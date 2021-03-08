    @extends('layouts.admin')

    @section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>

                                <li class="breadcrumb-item active">الملف الشخصي
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل الملف الشخصي </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('update.profile')}}"
                                                method="POST"
                                                enctype="multipart/form-data">
                                            @csrf
                                            @method('put')

                                            <input type="hidden" name="id" value="{{$admin -> id}}">

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الملف الشخصي</h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم </label>
                                                            <input type="text" value="{{$admin -> name }}" id=""
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> البريد الالكتروني </label>
                                                            <input type="email" value="{{$admin -> email }}" id=""
                                                                    class="form-control"
                                                                    placeholder="  "
                                                                    name="email">
                                                                    @error("email")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">

                                                            <label for="projectinput1"> كلمة المرور الجديدة </label>
                                                            <input type="password" value="" id=""
                                                                   class="form-control"
                                                                   placeholder="  كلمة المرور الجديدة"
                                                                   name="password">
                                                            @error("password")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">تاكيد كلمة المرور الجديدة </label>
                                                            <input type="password" value="" id=""
                                                                   class="form-control"
                                                                   placeholder=" تاكيد كلمة المرور الجديدة  "
                                                                   name="password_confirmation">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div id="map" style="height: 500px;width: 1000px;"></div> -->

                                            <div class="form-actions">

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
    @endsection
