@extends('admin.layouts')

@section('title')
	Thêm bài viết
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm bài viết</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Thêm bài viết</div>
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body">
                        <div class="row" style="margin-bottom:40px">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="category_id[]" id="chosen_select" multiple="" size="7" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Danh mục {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label>Title bài viết</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                                    @error('title')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Title bài viết {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label>Tác giả</label>
                                    <input type="text" name="author" value="{{ old('author') }}" class="form-control">
                                    @error('author')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Tác giả {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="2">Hiện</option>
                                        <option value="1">ẩn</option>
                                    </select>
                                    @error('status')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Trạng thái {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ảnh tiêu đề bài viết</label>
                                    @error('img')
									<div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Ảnh bài viết {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
									@enderror
                                    <input id="img" type="file" name="img" value="{{ old('img') }}" class="form-control hidden"
                                        onchange="changeImg(this)">
                                    <img id="avatar" class="thumbnail" width="100%" height="350px" src="img/import-img.png">
                                </div>
                            </div>
                            
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Chi tiết bài viết</label>
                                        <textarea id="editor" class="editor" name="description" style="width: 100%;height: 100px;">{{ old('description') }}</textarea>
                                        <script>
                                            var options = {
                                              filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                                              filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                                              filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                                              filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
                                            };
                                          </script>
                                        <script type="text/javascript">
                                            CKEDITOR.replace("editor", options);
                                        </script>
                                        @error('description')
                                        <div class="alert bg-danger" role="alert">
                                            <svg class="glyph stroked cancel">
                                                <use xlink:href="#stroked-cancel"></use>
                                            </svg>Chi tiết bài viết {{ $message }}!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-success" type="submit">Thêm bài viết</button>
                                    <a href="{{ route('post.index') }}" class="btn btn-danger" >Huỷ bỏ</a>
                                </div>
                            </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
                </div>

        </div>
    </div>

    <!--/.row-->
</div>
@endsection
@push('scripts')
    
@endpush