@extends('layouts.base')

@section('content')
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card border-0 shadow-sm rounded">
					<div class="card-body">
						<img src="{{ asset('storage/posts/' . $post->image) }}" class="w-100 rounded">
						<hr>
						<h4>{{ $post->title }}</h4>
						<p class="tmt-3">
							{!! $post->content !!}
						</p>
						<div class="my-3">
							<a href="{{ route('posts.index') }}" class="btn btn-sm btn-dark">KEMBALI</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
