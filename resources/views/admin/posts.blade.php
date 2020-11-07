@extends('admin.layouts')

@section('title')
	Trang quản lý bài viết
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Danh sách bài viết</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh sách bài viết</h1>
		</div>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">

			<div class="panel panel-primary">

				<div class="panel-body">
					<div class="bootstrap-table">
						<div class="table-responsive">
							@if (session('success'))
							<div class="alert bg-success" role="alert">
								<svg class="glyph stroked checkmark">
									<use xlink:href="#stroked-checkmark"></use>
								</svg>{{ session('success') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
							</div>
							@endif
							@if (session('failed'))
							<div class="alert bg-danger" role="alert">
								<svg class="glyph stroked checkmark">
									<use xlink:href="#stroked-checkmark"></use>
								</svg>{{ session('failed') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
							</div>
							@endif
							<a href="{{ route('post.create') }}" class="btn btn-primary">Thêm bài viết</a>
							<h3>Tổng số bài viết là: {{ count($posts) }}</h3>
							<table class="table table-bordered" style="margin-top:20px;">

								<thead>
									<tr class="bg-primary">
										<th>ID</th>
										<th>Thông tin bài viết</th>
										<th>Danh mục</th>
										<th>Trạng thái</th>
										{{-- <th>Chi tiết</th> --}}
										<th width='18%'>Tùy chọn</th>
									</tr>
								</thead>
								<tbody>
									<form id="frm_post" action="{{ route('post.destroy') }}" method="post">
										@csrf
										<input type="hidden" name="delete_id" id="delete_id" value="">
										<input type="hidden" name="delete_title" id="delete_title">
									</form>
									@foreach ($posts as $post)
									<tr>
										<td>{{ $post->id }}</td>
										<td>
											<div class="row">
												<div class="col-md-3"><img src="{{ asset('storage/photos/image').'/'.$post->img }}" alt="" width="100px" class="thumbnail"></div>
												<div class="col-md-9">
													<p class="margin-10"><strong>Title bài viết : {{ $post->title }}</strong></p>
													<p class="margin-10">Tác giả : {{ $post->author }}</p>
													<p class="margin-10">Views : {{ $post->view_count }}</p>
												</div>
											</div>
										</td>
										<td style="text-align: center;">@foreach ($post->categories as $cate)
												<a class="btn btn-primary" style="margin: 2px; " href="javascrip:void(0)" role="button">{{ $cate->name }}</a>
										@endforeach</td>
										<td>
											@if ($post->status == 2)
												<a class="btn btn-success" href="#" role="button">Hiện</a>
											@else
												<a class="btn btn-danger" href="#" role="button">Ẩn</a>
											@endif	
										</td>
										{{-- <td class="col-md-1" style="word-wrap: break-word;">{{ filter_var($post->description) }}</td> --}}
										<td>
											<a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
											<a href="javascript:void(0)" class="btn btn-danger delete-post" data-title="{{ $post->title }}" data-id="{{ $post->id }}" ><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
										</td>
									</tr>
									@endforeach
								
								</tbody>
							</table>
							<div align='right'>
								<ul class="pagination">
									{{ $posts->links() }}
								</ul>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

				</div>
			</div>
			<!--/.row-->


		</div>
@endsection
@push('scripts')
	<script>
		$(document).ready(function () {
			$('.delete-post').click(function () {
				let id = $(this).attr('data-id')
				let title = $(this).attr('data-title')
				$('#delete_id').attr('value', id)

				if (confirm('Bạn có muốn xóa '+title+' không !')) {
					$('#frm_post').submit()
				}
			})
		})
	</script>
@endpush