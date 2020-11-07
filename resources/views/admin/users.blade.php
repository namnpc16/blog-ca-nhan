@extends('admin.layouts')

@section('title')
	Trang quản lý users
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Danh sách users</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh sách users</h1>
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
							<a href="{{ route('user.create') }}" class="btn btn-primary">Thêm user</a>
							<h3>Tổng số người dùng là: {{ count($users) }}</h3>
							<table class="table table-bordered" style="margin-top:20px;">

								<thead>
									<tr class="bg-primary">
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th width='18%'>Tùy chọn</th>
									</tr>
								</thead>
								<tbody>
									<form id="frm_user" action="{{ route('user.destroy') }}" method="post">
										@csrf
										<input type="hidden" name="delete_id" id="delete_id">
									</form>
									@foreach ($users as $user)
										<tr>
											<td>{{ $user->id }}</td>
											
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>
												@if ($user->role == 2)
													<a class="btn btn-success" href="#" role="button">Admin</a>
												@else
													<a class="btn btn-danger" href="#" role="button">User</a>
												@endif
											</td>
											<td>
												<a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a href="javascript:void(0)" data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="btn btn-danger delete_id"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div align='right'>
								<ul class="pagination">
									{{ $users->links() }}
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
			$('.delete_id').click(function () {
				let id = $(this).attr('data-id')
				let name = $(this).attr('data-name')
				$('#delete_id').attr('value', id)
				if (confirm('Bạn có muốn xóa '+name+' không !')) {
					$('#frm_user').submit()
				}

			
			})
		})

	</script>
@endpush