@extends("layouts.app")

@section("content")
<div class="container">
    <div class="">
        @if (session("status"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("status") }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between">
            <h4 class="">{{ __("Manage Article") }}</h4>
            <div class="d-flex align-items-center">
                <form action="{{ route("article.index") }}">
                    <input
                        id="search"
                        type="text"
                        class="form-control"
                        name="search"
                        value="{{ old("search") }}"
                        required
                        autocomplete="search"
                        autofocus
                    />
                </form>
                <a class="btn btn-sm btn-primary ms-3" href="{{ route("article.create") }}">
                    {{ __("Add") }}
                </a>
            </div>
        </div>

        <div class="table-responsive mt-4" style="height: 75vh;">
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td valign="middle">
                            <img src="{{ env("APP_URL") . "/storage/articles/{$article->image}" }}" alt="Image" width="50">
                        </td>
                        <td valign="middle">{{ $article->title }}</td>
                        <td valign="middle">{{ $article->description }}</td>
                        <td valign="middle" class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __("Action") }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route("article.edit", $article->id) }}">{{ __("Edit") }}</a></li>
                                    <form method="POST" action="{{ route("article.destroy", $article->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <li><button class="dropdown-item" type="submit">{{ __("Delete") }}</button></li>
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
