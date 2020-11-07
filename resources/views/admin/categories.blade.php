@extends('admin.layouts')

@section('title')
	Trang quản lý danh mục
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Danh mục</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý danh mục</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					@if (session('success'))
						<div class="alert bg-success" role="alert">
							<svg class="glyph stroked checkmark">
								<use xlink:href="#stroked-checkmark"></use>
							</svg>{{ session('success') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
						</div>
					@endif
					<div class="row">
                        {{-- {{ route('category.create') }} --}}
						<form action="{{ route('category.store') }}" method="POST">
							@csrf
							<div class="col-md-5">
								<div class="form-group">
									<label for="">Trang thái</label>
									<select class="form-control" name="status" id="">
										<option value="2" selected>hiện</option>
                                        <option value="1">ẩn</option>
									</select>
								</div>
								<div class="form-group">
                                    <label for="">Tên Danh mục</label>
									<input type="text" class="form-control" name="name" id="" value="{{ old('name') }}" placeholder="Tên danh mục mới">
									@error('name')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Tên danh mục {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
									@if (session('failed'))
										<div class="alert bg-danger" role="alert">
											<svg class="glyph stroked checkmark">
												<use xlink:href="#stroked-checkmark"></use>
											</svg>{{ session('failed') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
										</div>
									@endif
								</div>
								<button type="submit" class="btn btn-primary">Thêm danh mục</button>
							</div>
						</form>
						<div class="col-md-7">
							
							<h3 style="margin: 0px;"><strong>Menu</strong></h3>
							<div class="vertical-menu">
								<div class="item-menu active">Danh mục </div>
								<form id="frm_cate" action="{{ route('category.destroy') }}" method="post">
									@csrf
									<input type="hidden" id="delete_id" name="delete_id" value="">
								</form>
								@foreach ($categories as $category)
									<div class="item-menu"><span>{{ $category->name }}</span>
										<div class="category-fix">
											<a class="btn-category btn-primary" href="{{ route('category.edit', ['id' => $category->id]) }}"><i class="fa fa-edit"></i></a>
											<a class="btn-category btn-danger delete_category" data-id="{{ $category->id }}" data-name="{{ $category->name }}" href="javascript:void(0)"><i class="fas fa-times"></i></i></a>
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

@push('scripts')
	<script>
		$(document).ready(function(){
			$('.delete_category').click(function(){
				let name = $(this).attr('data-name')
				let id = $(this).attr('data-id')
				$('#delete_id').attr('value', id)
				
				if (confirm('Bạn có muốn xóa danh mục '+name+'!')) {
					$('#frm_cate').submit()
				}
			})
		})
	</script>
@endpush