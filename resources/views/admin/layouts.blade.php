
<!DOCTYPE html>
<html>
	
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}backend/">
	<!-- css -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/styles.css?id={{ date('YmdHis') }}" rel="stylesheet">
	<link href="css/config.css?id={{ date('YmdHis') }}" rel="stylesheet">
	<!--Icons-->
	<script src="js/lumino.glyphs.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" href="Awesome/css/all.css">
</head>
<body>
	<!-- header -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><span>vietpro </span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
            {{-- {{ Auth::user()->name }} --}}
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Xin chào:  <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu"><li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Thông tin</a></li>
						<li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<!-- header -->
	<!-- sidebar left-->
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
		</form>
    <ul class="nav menu">
      {{-- <li class="active"><a href="#"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tổng quan</a></li>
      <li class=""><a href="#"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> POSTS</a></li>
      <li class=""><a href="#"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> CATEGORIES</a></li>
	  <li class=""><a href="#"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-male-user"></use></svg> USERS</a></li> --}}
			<li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tổng quan</a></li>
			<li class="{{ Request::routeIs('category.*') ? 'active' : '' }}"><a href="{{ route('category.index') }}"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper" /></svg> Danh Mục</a></li>
			<li class="{{ Request::routeIs('post.*') ? 'active' : '' }}"><a href="{{ route('post.index') }}"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Bài viết</a></li>
			{{-- <li class="{{ Request::routeIs('order.*') ? 'active' : '' }}"><a href="{{ route('order.index') }}"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad" /></svg> Đơn hàng</a></li> --}}
			{{-- <li role="presentation" class="divider"></li> --}}
			<li class="{{ Request::routeIs('user.*') ? 'active' : '' }}"><a href="{{ route('user.index') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Quản lý thành viên</a></li>
		</ul>

	</div>
	<!--/. end sidebar left-->

	<!--main-->
	@yield('content')
	<!--end main-->

	<!-- javascript -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	
	<script src="{{ asset('js/laroute.js') }}"></script>
	{{-- <script src="js/chart-data.js"></script> --}}
	<script>
		function changeImg(input){
			   //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
			   if(input.files && input.files[0]){
				   var reader = new FileReader();
				   //Sự kiện file đã được load vào website
				   reader.onload = function(e){
					   //Thay đổi đường dẫn ảnh
					   $('#avatar').attr('src',e.target.result);
				   }
				   reader.readAsDataURL(input.files[0]);
			   }
		   }
		   $(document).ready(function() {
			   $('#avatar').click(function(){
				   $('#img').click();
			   });
		   });
   
	   </script>
	@stack('scripts')
</body>

</html>