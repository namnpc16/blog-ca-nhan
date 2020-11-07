@extends('admin.layouts')

@section('title')
	Sửa danh mục
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Sửa danh mục</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Sửa danh mục</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
							@csrf
							<div class="col-md-5">
								<div class="form-group">
									<label for="">Trang thái</label>
									<select class="form-control" name="status" id="">
										<option value="2" @if ($category->status == 2)
                                             selected 
                                        @endif>hiện</option>
                                        <option value="1" @if ($category->status == 1)
                                             selected 
                                        @endif>ẩn</option>
                                        
									</select>
								</div>
								<div class="form-group">
                                    <label for="">Tên Danh mục</label>
									<input type="text" class="form-control" name="name" id="" value="{{ $category->name }}" placeholder="Tên danh mục mới">
									@error('name')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Tên danh mục {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
								</div>
                                <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                                <a href="{{ route('category.index') }}" class="btn btn-danger">Thoát</a>
							</div>
						</form>
						<div class="col-md-7">
							
							<h3 style="margin: 0px;"><strong>Menu</strong></h3>
							<div class="vertical-menu">
								<form action="" method="post">
									@csrf
									
								</form>
								<div class="item-menu active">Danh mục </div>
                                @foreach ($categories as $cate)
                                
									<div class="item-menu @if ($category->id == $cate->id) active  @endif"><span>{{ $cate->name }}</span>
										<div class="category-fix">
											<a class="btn-category btn-danger"  href="#"><i class="fas fa-times"></i></i></a>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/.col-->


	</div>
	<!--/.row-->
</div>
@endsection
