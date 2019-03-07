<h3>{{ $category }}</h3>
@include(config('blog.template_summary'), ['items' => $items])