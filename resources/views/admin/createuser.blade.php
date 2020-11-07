@extends('admin.layouts')

@section('title')
	Thêm thành viên
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm Thành viên</h1>
        </div>
    </div>
    <!--/.row-->
<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fas fa-user"></i> Thêm thành viên</div>
                <div class="panel-body">
                    <div class="row justify-content-center" style="margin-bottom:40px">

                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="col-md-8 col-lg-8 col-lg-offset-2">
                         
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                    @error('email')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Email người dùng {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label>password</label>
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                                    @error('password')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Password {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Tên người dùng {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                                
                              
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="level" class="form-control">
                                        <option value="2">admin</option>
                                        <option selected value="1">user</option>
                                    </select>
                                    @error('level')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Quyền người dùng {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-lg-offset-2 text-right">
                                  
                                    <button class="btn btn-success"  type="submit">Thêm thành viên</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-danger" type="reset">Huỷ bỏ</a>
                                </div>
                            </div>
                        </form>
                       

                    </div>
                
                    <div class="clearfix"></div>
                </div>
            </div>

    </div>
</div>

    <!--/.row-->
</div>
@endsection
