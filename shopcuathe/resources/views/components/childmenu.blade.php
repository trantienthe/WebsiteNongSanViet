@if($CategoryParent -> categoryChildrent -> count())
	<ul role="menu" class="sub-menu">
		@foreach($CategoryParent -> categoryChildrent as $categoryChild )
			<li>
                <a href="{{ $categoryChild -> id}}">{{ $categoryChild -> name}}</a>
                @if($categoryChild -> categoryChildrent -> count())
                    @include('components.childmenu', ['categoryParent' -> $categoryChild])
                @endif
            </li>
		@endforeach
	</ul>
@endif