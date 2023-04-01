@extends('layouts.base')

@section('content')
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="card border-0 shadow-sm rounded">
					<div class="card-body">
						<a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">JUDUL</th>
									<th scope="col">CONTENT</th>
									<th scope="col">GAMBAR</th>
									<th scope="col">AKSI</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($posts as $post)
									<tr>		
										<td>{{ $post->title }}</td>
										<td>{!! $post->content !!}</td>
										<td class="text-center">
											<img src="{{ asset('/storage/posts/' . $post->image) }}" class="rounded img-fluid post-content-img">
										</td>
										<td class="text-center">
											<form onsubmit="return confirm('Apakah Anda Yakin menghapus data ini ?');"
												action="{{ route('posts.destroy', $post->id) }}" method="POST">
												<a href="{{ route('posts.show', $post->id) }}"
													class="btn btn-sm btn-dark">SHOW</a>
												<a href="{{ route('posts.edit', $post->id) }}"
													class="btn btn-sm btn-primary">EDIT</a>
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
											</form>
										</td>
									</tr>
								@empty
									<div class="alert alert-danger">
										Data Post belum Tersedia.
									</div>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footerScript')
<script>
        //message with toastr
		@if(session()->has('success'))
		
				console.log('success');

		@elseif(session()->has('error'))

				console.log('error');
				
		@endif
</script>
@endsection