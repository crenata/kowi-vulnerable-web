@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h4 class="">{{ __("Manage Article") }}</h4>

            <div class="mt-4">
                <form method="POST" action="{{ route("article.update", $article->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="">
                        <label for="title">{{ __("Title") }}</label>
                        <input
                            id="title"
                            type="text"
                            class="form-control @error("title") is-invalid @enderror"
                            name="title"
                            value="{{ old("title", $article->title) }}"
                            required
                            autocomplete="title"
                            autofocus
                        />
                        @error("title")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="image">{{ __("Image") }}</label>
                        <input
                            id="image"
                            type="text"
                            class="form-control @error("image") is-invalid @enderror"
                            name="image"
                            value="{{ old("image", $article->image) }}"
                            required
                            autocomplete="image"
                            accept="image/*"
                        />
                        @error("image")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="description">{{ __("Description") }}</label>
                        <textarea
                            id="description"
                            rows="4"
                            class="form-control @error("description") is-invalid @enderror"
                            name="description"
                            required
                            autocomplete="description"
                            autofocus
                        >{{ old("description", $article->description) }}</textarea>
                        @error("description")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route("article.index") }}" class="btn btn-secondary">
                            {{ __("Cancel") }}
                        </a>
                        <button type="submit" class="btn btn-primary ms-3">
                            {{ __("Edit") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
